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
        "image",
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

    public function productBrand() {
        return $this->belongsTo( Brand::class, "brand", "id" );
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

    public function scopeFilter( $query ) {

        if ( !empty( request()->brand ) ) {
            $brands = [];

            foreach ( request()->brand as $key => $value) {
                $brands[] = $key;
            }

            $query->whereIn( "brand", $brands );

        }

        if (  $search = request()->search ) {
            $query->where( "name", "like", "%". $search ."%" );
        }

        if ( $sort_price = request()->sort_price )  {
            if ( $sort_price == "hight_to_low" ) {
                $orderBy = "DESC";
            } else {
                $orderBy = "ASC";
            }
            $query->orderBy( "original_price", $orderBy );
        }
        return $query;
    }
}
