<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryPostReponsitory {
    protected $category = null;

    public function __construct( Category $category ) {
        $this->category = $category;
    }

    public function create( $attributes ) {
        return $this->category->create( $attributes );
    }

    public function allCategory( ) {
        return $this->category->with( "posts" )->get();
    }

    public function categoryWithPost() {
        return $this->category->search()->with( "posts" )->get();
    }

    public function searchCategory( $name ) {
        return $this->category->where( "name", "like", "%" . $name . "%" )->with( "posts" )->get();
    }

    public function pagination( $row ) {
        return $this->category->search()->paginate( $row );
    }

    public function update( $attributes, $category ) {
        return $category->update( $attributes );
    }

    public function whereCate( $id ) {
        return Category::with('posts')->find( $id );
    }

    public function whereSlug( $slug ) {
        return $this->category->where( "slug", $slug )->first();
    }

    public function find( $id ) {
        return $this->category->find( $id );
    }
}
