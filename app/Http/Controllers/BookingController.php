<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Travel;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Flight;
use Illuminate\Support\Facades\Validator;
use App\CentralLogics\Helpers;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function all($user)
    {
        $hotels = Booking::with('room','hotel','travel','flight')->where("user_id",$user)->get();

        $data =  [
            'total_size' => $hotels->count(),
            'hotels' => $hotels
        ];

        return response()->json($data, 200);
    }

    public function order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'room_id' => 'exists:rooms,id',
            'user_id' => 'exists:users,id',
            'travel_id' => 'exists:travels,id',
            'hotel_id' => 'exists:hotels,id',
            'flight_id' => 'exists:flights,id',
            'start_date' => 'required',
            'end_date' => 'required',
            'guest_name' => 'required|string',
            'guest_email' => 'required|email',
            'payment_method' => 'required|string',
            'room_quality' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $checkIn = Carbon::createFromFormat('d/m/Y',$request->start_date);
        $checkOut = Carbon::createFromFormat('d/m/Y',$request->end_date);

        $numberOfDays = $checkOut->diffInDays($checkIn);

        if($request->hotel_id != null && $request->room_id != null){
            $hotel = Hotel::findOrFail($request->hotel_id );
            $room = Room::findOrFail($request->room_id );

            $total_amount = ( $hotel['price'] + ( $room['price'] * $request->guest )) * $numberOfDays;
        }

        // Create a new order
        $bookings = Booking::create([
            'travel_id' => $request->travel_id,
            'user_id' => $request->user_id,
            'hotel_id' => $request->hotel_id,
            'room_id' => $request->room_id,
            'flight_id' => $request->flight_id,
            'guest' => $request->guest,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'room_quality' => $request->room_quality,
            'payment_method' => $request->payment_method,
            'total_amount' => $total_amount,
            'card_name' => $request->card_name,
            'card_number' => $request->card_number,
            'card_cvv' => $request->card_cvv,
            'card_expiration' => $request->card_expiration,
        ]);

        $data =  [
            'bookings' => $bookings
        ];

        return response()->json($data, 200);
    }
}
