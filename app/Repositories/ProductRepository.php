<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository {
    private $product = null;

    public function __construct( Product $product ) {
        $this->product = $product;
    }

    public function all() {
        return $this->product->orderBy( "id", "DESC" )->with( "category_products" )->paginate( 5 );
    }

    public function findOrFail( $id ) {
        return $this->product->findOrFail( $id );
    }

    public function trending() {
        return $this->product->with( "productImages", "category_products" )->where( "trending", true )->limit( 10 )->get();
    }

    public function slug( $slug ) {
        return $this->product->with( "productImages", "category_products" )->where( "slug", $slug )->first();
    }
}
