<?php
namespace App\Services;

use App\Repositories\CategoryProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryProductService {
    private $categoryProductRepository = null;

    public function __construct( CategoryProductRepository $categoryProductRepository ) {
        $this->categoryProductRepository = $categoryProductRepository;
    }

    public function paginateCateProduct() {
        return $this->categoryProductRepository->paginateCategoryProduct();
    }

    public function allCateProduct() {
        return $this->categoryProductRepository->allCateProduct();
    }

    public function brands( $category_id ) {
        return $this->categoryProductRepository->whereBrands( $category_id );
    }

    public function createCateProduct( Request $request ) {
        $request[ 'image' ] = str_replace( $request->root() . "/storage/", "", $request->image );
        $request["status"] = ( $request->status == "on" ) ? 1 : 0 ;
        $request['slug'] = Str::slug( $request->name );
        return $this->categoryProductRepository->create( $request->all() );
    }

    public function editCategoryProduct( $id ) {
        $category = $this->findCategoryProduct( $id );
        $categories = $this->allCategoryProduct();
        return view( 'admin.category.product.edit', compact( "category", "categories" ) );
    }

    public function findCategoryProduct( $id ) {
        return $this->categoryProductRepository->find( $id );
    }

    public function allCategoryProduct() {
        return $this->categoryProductRepository->allCategory();
    }

    public function update( Request $request, $id ) {
        $request[ 'image' ] = str_replace( $request->root() . "/storage/", "", $request->image );
        $request[ "status" ] = ( $request->status == "on" ) ? 1 : 0 ;
        $request[ "slug" ] =  Str::slug( $request->name );
        return $this->categoryProductRepository->updateCategoryProduct( $request->all() , $id );
    }

    public function delete( $id ) {
        $this->categoryProductRepository->deleteCategoryPost( $id );
        return Alert::toast( 'Post Deleted Successfully.', 'success' );
    }

    public function categoryProductSlug( $slug ) {
        return $this->categoryProductRepository->cateProductSlug( $slug );
    }

    public function categorySlug( $slug ) {
        return $this->categoryProductRepository->categorySlug( $slug );
    }
}

