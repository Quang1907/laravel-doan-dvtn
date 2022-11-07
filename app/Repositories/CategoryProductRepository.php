<?php
namespace App\Repositories;

use App\Models\CategoryProduct;

class CategoryProductRepository {
    private $categoryProduct = null;

    public function __construct( CategoryProduct $categoryProduct ) {
        $this->categoryProduct = $categoryProduct;
    }

    public function paginateCategoryProduct() {
        return $this->categoryProduct->paginate( 5 );
    }

    public function allCateProduct() {
        return $this->categoryProduct->all();
    }

    public function create( $attribute ) {
        return $this->categoryProduct->create( $attribute );
    }
}

