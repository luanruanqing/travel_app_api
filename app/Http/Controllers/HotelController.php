<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\RoomService;

class HotelController extends Controller
{
        public function getAll()
    {
        $hotels = Hotel::with('location','images','reviews')->has('images')
        ->whereHas('reviews', function ($query) {
            $query->where('rating','>',0);
        })
        ->get()
        ->sortByDesc(function ($hotel) {
            $ratingSum = $hotel->reviews->sum('rating');
            $ratingCount = $hotel->reviews->count();
            $rating = $ratingCount > 0 ? $ratingSum / $ratingCount : 0;

            $hotel->rating = $rating;
        })
        ->take(10);

        $data =  [
            'total_size' => $hotels->count(),
            'hotels' => $hotels
        ];

        return response()->json($data, 200);
    }

    public function detail($hotel){
        $hotels = Hotel::with('location','services','images','reviews')->whereHas('reviews', function ($query) {
            $query->where('rating','>',0);
        })->where("id",$hotel)->get()->sortByDesc(function ($hotel) {
            $ratingSum = $hotel->reviews->sum('rating');
            $ratingCount = $hotel->reviews->count();
            $rating = $ratingCount > 0 ? $ratingSum / $ratingCount : 0;

            $hotel->rating = $rating;
        });

        $data =  [
            'total_size' => $hotels->count(),
            'hotels' => $hotels
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
