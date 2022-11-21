<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        "name",
        "category_id",
        "slug",
        "brand",
        "small_description",
        "description",
        "original_price",
        "selling_price",
        "quantity",
        "trending",
        "status",
        "meta_title",
        "meta_description",
        "meta_keyword"
    ];

    public function productImages() {
        return $this->hasMany( ProductImage::class, "product_id", "id" );
    }

    public function productColorTable() {
        return $this->hasMany( ProductColor::class, "product_id", "id" );
    }

    public function productColors() {
        return $this->belongsToMany( Color::class, "product_colors", "product_id", "color_id" )->withPivot( 'quantity' );
    }

    public function category_products() {
        return $this->belongsTo( CategoryProduct::class , "category_id",  "id" );
    }
}
