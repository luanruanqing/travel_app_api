<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = "images";

    protected $fillable = [
        'image_url'
    ];

    public function hotels()
    {
        return $this->belongsToMany(
            Hotel::class,
            'hotel_image',
            'image_id',
            'hotel_id'
        );
    }

    public function rooms()
    {
        return $this->belongsToMany(
            Room::class,
            'hotel_image',
            'image_id',
            'room_id'
        );
    }

    public function travels()
    {
        return $this->belongsToMany(
            Travel::class,
            'travel_image',
            'image_id',
            'travel_id'
        );
    }

    public function reviews()
    {
        return $this->belongsToMany(
            Review::class,
            'image_review',
            'review_id',
            'image_id'
        );
    }
}
