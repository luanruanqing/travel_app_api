<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = "locations";

    protected $fillable = [
        'name','image_url','latitude','longitude','description'
    ];

    public function travels()
    {
        return $this->hasMany(Travel::class);
    }
}
