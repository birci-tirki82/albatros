<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "category_id",
        "tur",
        "name",
        "slug",
        "description",
        "price",
        "old_price",
        "stok",
        "image",
        "is_active"
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

}
