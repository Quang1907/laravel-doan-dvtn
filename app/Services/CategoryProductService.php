<?php
namespace App\Services;

use App\Repositories\CategoryProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function createCateProduct( Request $request ) {
        $request[ 'image' ] = str_replace( $request->root(), "", $request->image );
        $request["status"] = ( $request->status == "on" ) ? 1 : 0 ;
        $request['slug'] = Str::slug( $request->name );
        return $this->categoryProductRepository->create( $request->all() );
    }
}

