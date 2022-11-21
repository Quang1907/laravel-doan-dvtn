<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Services\CategoryProductService;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    private $categoryProductService = null;
    public function __construct( CategoryProductService $categoryProductService ) {
        $this->categoryProductService = $categoryProductService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_products = $this->categoryProductService->paginateCateProduct();
        return view( 'admin.category.product.index', compact( 'category_products' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_products = $this->categoryProductService->allCateProduct();
        return view( 'admin.category.product.create' , compact( "category_products" ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( CreateCategoryRequest $request )
    {
        $this->categoryProductService->createCateProduct( $request );
        return redirect()->route( "category-products.index" )->with( "message", "Category Created Successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        return $this->categoryProductService->editCategoryProduct( $id );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        $this->categoryProductService->update( $request, $id );
        return redirect()->route( "category-products.index" )->with( "message", "Category Updated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        $this->categoryProductService->delete( $id );
        return redirect()->route( "category-products.index" );
    }
}
