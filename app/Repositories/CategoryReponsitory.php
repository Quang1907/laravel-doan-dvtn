<?php
namespace App\Repositories;

use App\Models\Category;

class CategoryReponsitory {
    protected $category = null;

    public function __construct( Category $category ) {
        $this->category = $category;
    }

    public function create( $attributes ) {
        return $this->category->create( $attributes );
    }

    public function all() {
        return $this->category->all();
    }

    public function pagination( $row ) {
        return $this->category->search()->paginate( $row );
    }

    public function update( $attributes, $category ) {
        return $category->update( $attributes );
    }
}
