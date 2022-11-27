<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    protected $table = "posts_comments";
    protected $fillable = [ "user_id", "content", "post_id", "parent_id" ];

    public function user() {
        return $this->belongsTo( User::class, "user_id", "id" );
    }
}
