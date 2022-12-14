<?php
namespace App\Repositories;

use App\Models\CategoryProduct;

class CategoryProductRepository {
    private $categoryProduct = null;

    public function __construct( CategoryProduct $categoryProduct ) {
        $this->categoryProduct = $categoryProduct;
    }

    public function paginateCategoryProduct() {
        return $this->categoryProduct->search()->paginate( 5 );
    }

    public function allCateProduct() {
        return $this->categoryProduct->get();
    }

    public function create( $attribute ) {
        return $this->categoryProduct->create( $attribute );
    }

    public function whereBrands( $id ) {
        return $this->categoryProduct->findOrFail( $id );
    }

    public function find( $id ) {
        return $this->categoryProduct->findOrFail( $id );
    }

    public function allCategory() {
        return $this->categoryProduct->get();
    }

    public function updateCategoryProduct( $attribute, $id ) {
        $find = $this->categoryProduct->where( "id", $id)->firstOrFail();
        return $find->update( $attribute );
    }

    public function deleteCategoryPost( $id ) {
        return $this->categoryProduct->where( "id", $id)->delete();
    }

    public function categorySlug( $slug ) {
        return $this->categoryProduct->where( "slug", $slug )->firstOrFail();
    }

    public function cateProductSlug( $slug ) {
        $cate = $this->categoryProduct->where( "slug", $slug )->firstOrFail();
        return $cate->products()->with( "category_products", "productImages" )->paginate( 10 );
    }
}

