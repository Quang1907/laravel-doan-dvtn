<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [ "name", "slug", "status", "brand_category_id" ];

    public function category_products( ) {
        return $this->belongsTo( CategoryProduct::class, "brand_category_id", "id" );
    }
}
