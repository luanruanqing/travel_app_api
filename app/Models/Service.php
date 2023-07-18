<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = "services";

    protected $fillable = [
        'name','thumbnail','description'
    ];

    public function hotels()
    {
        return $this->belongsToMany(
            Hotel::class,
            'hotel_service',
            'service_id',
            'hotel_id'
        );
    }

    public function rooms()
    {
        return $this->belongsToMany(
            Room::class,
            'hotel_service',
            'service_id',
            'room_id'
        );
    }
}
