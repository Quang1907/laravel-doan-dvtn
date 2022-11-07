<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $table = "category_products";
    protected $fillable = [ "name", "slug", "description", "status", "image", "meta_title", "meta_description", "meta_keyword", "parent_id"];
}
