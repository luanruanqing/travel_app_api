<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelImage extends Model
{
    use HasFactory;

    protected $table = "travel_image";

    protected $fillable = [
        'travel_id',
        'image_id',
    ];
}
