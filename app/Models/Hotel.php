<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $table = "hotels";

    protected $fillable = [
        'location_id','name','address','description','price'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function images()
    {
        return $this->belongsToMany(
            Image::class,
            'hotel_image',
            'hotel_id',
            'image_id'
        );
    }

    public function services()
    {
        return $this->belongsToMany(
            Service::class,
            'hotel_service',
            'hotel_id',
            'service_id'
        );
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
