<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPosts extends Model
{
    use HasFactory;
    protected $table = "category_posts";
    protected $guarded = [];

    public function posts() {
        return $this->belongsTo( Post::class , "posts_id",  "id" );
    }
}
