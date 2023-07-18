<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = "rooms";

    protected $fillable = ['hotel_id','name','size','description','price'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
    public function services()
    {
        return $this->belongsToMany(
            Service::class,
            'room_service',
            'room_id',
            'service_id'
        );
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
