<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageReview extends Model
{
    use HasFactory;

    protected $table = "image_review";

    protected $fillable = [
        'image_id',
        'review_id',
    ];
}
