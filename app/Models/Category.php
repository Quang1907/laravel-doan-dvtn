<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [ "name", "slug", "description", "status", "image", "meta_title", "meta_description", "meta_keyword", "parent_id" ];

    public function posts()
    {
        return $this->belongstoMany( Post::class,  "category_posts", 'category_id',  'posts_id');
    }

    public function scopeSearch( $query ) {

        if ( $search = request()->search ) {
            $query->where( "name", "like", "%" . $search ."%" );
        }

        if ( $created_at = request()->date ) {
            $query->where( "created_at", "like", "%" . $created_at ."%" );
        }

        return $query;
    }

    // public function products() {
    //     return $this->hasMany( Product::class, "category_id", "id" );
    // }
}
