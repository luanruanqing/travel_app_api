<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = "reviews";

    protected $fillable = [
        'flight_id','travel_id','room_id','hotel_id','user_id','review_text','rating','like','dislike'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->belongsToMany(
            Image::class,
            'image_review',
            'image_id',
            'review_id'
        );
    }
}
