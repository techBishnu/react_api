<?php

namespace App\Models;

use App\Models\Category;
use Spatie\MediaLibrary\HasMedia;
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

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
