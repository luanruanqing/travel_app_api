<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function all($user)
    {
        $reviews = Review::with('room','hotel','travel','flight','images')->where("user_id",$user)->get();

        $data =  [
            'total_size' => $reviews->count(),
            'reviews' => $reviews
        ];

        return response()->json($data, 200);
    }
}
