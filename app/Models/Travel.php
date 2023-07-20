<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $table = "travels";

    protected $fillable = [
        'destination','location_id','description'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->belongsToMany(
            Image::class,
            'travel_image',
            'travel_id',
            'image_id'
        );
    }
}
