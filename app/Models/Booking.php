<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = "bookings";

    protected $fillable = [
        'travel_id','user_id','room_id','hotel_id','flight_id','guest_name','guest_email','start_date','end_date','guest','room_quality','total_amount','payment_method','card_name','card_number','card_cvv','card_expiration'
    ];

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}
