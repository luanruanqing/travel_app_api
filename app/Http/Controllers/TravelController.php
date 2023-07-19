<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Travel;
use App\Models\Location;
use App\Models\TravelImage;
use App\Models\Review;

class TravelController extends Controller
{
    public function all()
    {
        $travels = Travel::all();

        $data =  [
            'total_size' => $travels->count(),
            'travels' => $travels
        ];

        return response()->json($data, 200);
    }

    public function getNearest()
    {
        $travels = Travel::inRandomOrder()->with('images')
        ->take(4)
        ->get();

        $data =  [
            'total_size' => $travels->count(),
            'travels' => $travels
        ];

        return response()->json($data, 200);
    }

    public function detail($travel){
        $travel = Travel::findOrFail($travel);
        $rating_travel = 0;

        if(empty($travel->reviews)){
            foreach ($travel->reviews as $key => $value) {
                $total_rating += $value->rating;
            }
            $rating_travel = $total_rating / $travel->reviews->count();
        }

        $data =  [
            'total_size' => $travel->count(),
            'total_size_image' => $travel->images->count(),
            'total_size_reviews' => $travel->reviews->count(),
            'rating_travel' => $rating_travel,
            'travels' => $travel,
            'location' => $travel->location,
            'images' => $travel->images,
            'reviews' => $travel->reviews,
        ];
        return response()->json($data, 200);
    }

    public function popular()
    {

        $travels = Travel::with('images','location')->withCount('reviews')
        ->withSum('reviews', 'rating')
        ->orderBy('reviews_sum_rating', 'desc')
        ->limit(5)
        ->get();

        $travels = $travels->map(function ($travel) {
            $travel['rating'] = $travel['reviews_sum_rating'] / $travel['reviews_count'];
            return $travel;
        });

        $data =  [
            'total_size' => $travels->count(),
            'travels' => $travels
        ];

        return response()->json($data, 200);
    }

    public function recommended()
    {
        $travels = Travel::with('images','location')->inRandomOrder()
            ->limit(10)
            ->get();

        $data =  [
            'total_size' => $travels->count(),
            'travels' => $travels
        ];

        return response()->json($data, 200);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $travels = Travel::where('destination', 'like', '%' . $query . '%')
            ->get();

        $data =  [
            'total_size' => $travels->count(),
            'travels' => $travels
        ];

        return response()->json($data, 200);
    }
}
