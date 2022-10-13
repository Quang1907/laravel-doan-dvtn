<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [ "title", "content", "image", "user_id", "slug" ];

    public function categories()
    {
        return $this->belongstoMany( Category::class, "category_posts", 'posts_id', 'category_id' );
    }

    public function scopeSearch( $query ) {
        if ( !empty( request()->category_id ) ) {
            $query->whereHas( "categories" , function ( $query ) {
                $query =  $query->where( "id" , request()->category_id);
                return  $query;
            });
        }

        if ( $search = request()->search ) {
            $query->where( "title", "like", "%" . $search ."%" );
        }

        if ( $created_at = request()->date ) {
            $query->where( "created_at", "like", "%" . $created_at ."%" );
        }

        return $query;
    }
}
