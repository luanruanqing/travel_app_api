<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\RoomService;

class HotelController extends Controller
{
    public function getAll()
    {
        $hotels = Hotel::with('location','images')->whereHas('images', function ($query) {
            $query->whereNotNull('image_url');
        })->inRandomOrder()->limit(5)->get();

        $data =  [
            'total_size' => $hotels->count(),
            'hotels' => $hotels
        ];

        return response()->json($data, 200);
    }

    public function detail($hotel){
        $hotel = Hotel::with('location','services','images','reviews')->findOrFail($hotel);
        $rating_hotel = 0;

        if(empty($hotel->reviews)){
            foreach ($hotel->reviews as $key => $value) {
                $total_rating += $value->rating;
            }
            $rating_hotel = $total_rating / $hotel->reviews->count();
        }

        $data =  [
            'total_size' => $hotel->count(),
            'total_size_image' => $hotel->images->count(),
            'total_size_service' => $hotel->services->count(),
            'total_size_reviews' => $hotel->reviews->count(),
            'rating_hotel' => $rating_hotel,
            'hotel' => $hotel
        ];
        return response()->json($data, 200);
    }

    public function getHotelByCountry($country){
        $hotels = Hotel::where("location_id",$country)->get();

        $data =  [
            'total_size' => $hotels->count(),
            'hotels' => $hotels
        ];

        return response()->json($data, 200);
    }

    public function filter(Request $request){
        $query = Hotel::query();

        // Filter by price
        if ($request->has('start_price') && $request->has('end_price')) {
            $query->whereBetween('price', [$request->start_price, $request->end_price]);

            // Sort by price
            if ($request->has('sort')) {
                $sort = $request->sort;
                if ($sort === 'high') {
                    $query->orderByDesc('price');
                } elseif ($sort === 'low') {
                    $query->orderBy('price');
                }
            }

        }

        // Filter by services
        if ($request->has('services')) {
            $services = $request->services;
            $query->whereIn('service', $services);
        }

        // Retrieve filtered records
        $hotels = $query->get();

        $data =  [
            'total_size' => $hotels->count(),
            'hotels' => $hotels
        ];

        return response()->json($data, 200);
    }
}
