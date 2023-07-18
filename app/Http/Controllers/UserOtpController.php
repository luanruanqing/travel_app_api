<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use App\Models\UserOtp;
use App\Models\User;

class UserOtpController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function generate(Request $request)
    {
        /* Validate Data */
        $request->validate([
            'phone_number' => 'required|exists:users,phone_number'
        ]);

        /* Generate An OTP */
        $userOtp = $this->generateOtp($request->phone_number);
        $userOtp->sendSMS("+".$request->phone_number);

        return response()->json(200);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function generateOtp($phone_number)
    {
        $user = User::where('phone_number', $phone_number)->first();

        /* User Does not Have Any Existing OTP */
        $userOtp = UserOtp::where('user_id', $user->id)->latest()->first();

        $now = now();

        if ($userOtp && $now->isBefore($userOtp->expire_date)) {
            return $userOtp;
        }

        /* Create a New OTP */
        return UserOtp::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_date' => $now->addMinutes(10)
        ]);
    }

}
