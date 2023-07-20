<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function getAll()
    {
        $locations = Location::whereNotNull("image_url")->get();

        $data =  [
            'total_size' => $locations->count(),
            'locations' => $locations
        ];

        return response()->json($data, 200);
    }
}
