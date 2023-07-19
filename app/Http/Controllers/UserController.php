<?php

namespace App\Http\Controllers;

use App\CentralLogics\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Support\Facades\Validator;
use Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $data = [
            'phone_number' => $request->phone_number,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {

            if (auth()->user()->is_phone_verified != "on") {
                return response()->json([
                    'message' => trans('messages.your_account_is_phone_verified')
                ], 403);
            }

            $token = auth()->user()->createToken('UserLogin')->accessToken;

            return response()->json(
                [
                    'token' => $token->token,
                    'user' => Auth::user()
                ],
                200,
            );
        } else {
            return response()->json([
                'message' => 'Enter again your password and phone number!'
            ], 401);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'l_name' => 'required',
            'phone_number' => 'required|unique:users',
            'password' => 'required|min:6',
        ], [
            'f_name.required' => 'The first name field is required.',
            'l_name.required' => 'The last name field is required.',
            'phone_number.required' => 'The  phone field is required.',
            'phone_number.unique' => 'The  phone is exist.',
            'password.required' => 'The  password field is required.',
            'password.min' => 'The password min 6 character.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 403);
        }

        $user = User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'phone_number' => $request->phone_number,
            'password' => bcrypt($request->password),
            'avatar' => "images/none-avatar.png",
            'is_phone_verified' => "off"
        ]);

        $token = $user->createToken('RegisterUser')->accessToken;

        $this->sendOtp($request->phone_number);

        return response()->json(
            [
                'token' => $token->token,
                'user' => $user
            ],
            200,
        );
    }

    public function sendOtp($phone_number)
    {
        /* Generate An OTP */
        $userOtp = $this->sendOtpCheckPhone($phone_number);
        $userOtp->sendSMS($phone_number);

        return response()->json(['message' => trans('messages.sent_otp_success')], 200);
    }

    public function sendOtpCheckPhone($phone_number)
    {
        $user = User::where('phone_number', $phone_number)->first();

        $userOtp = UserOtp::where('user_id', $user->id)->latest()->first();
        $now = now();

        if ($userOtp && $now->isBefore($userOtp->expire_date)) {
            return $userOtp;
        }

        return UserOtp::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_date' => $now->addMinutes(10)
        ]);
    }

    public function verifyOtp(Request $request)
    {
        $user = User::where('phone_number', $request->phone_number)->latest()->first();
        $user_otp = UserOtp::where('user_id', $user->id)->latest()->first();

        if ($user_otp && $user_otp->otp == $request->otp) {
            $user->is_phone_verified = 'on';
            $user->update();
            $user_otp->delete();

            $token = $user->createToken('UserVerityOtp')->accessToken;
            return response()->json(
                [
                    'token' => $token->token,
                    'user' => $user
                ],
                200,
            );
        } else {
            return response()->json(['message' => trans('messages.otp_invalid')], 422);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($validatedData);

        return response()->json([
            'message' => trans('messages.user_update'),
            'user' => $user,
        ]);
    }
}
