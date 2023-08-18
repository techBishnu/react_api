<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    protected $fillable=[
        'category_id',
        'name',
        'description',
        'price',
        'quantity',
    ];
}
