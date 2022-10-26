<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository {
    private $product = null;

    public function __construct( Product $product ) {
        $this->product = $product;
    }

    public function all() {
        return $this->product->orderBy( "id", "DESC" )->with( "category" )->paginate( 5 );
    }

    public function findOrFail( $id ) {
        return $this->product->findOrFail( $id );
    }
}
