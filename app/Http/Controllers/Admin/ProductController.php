<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductFormRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService = null;

    public function __construct( ProductService $productService ) {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = $this->productService->allProduct();
        return view( "admin.product.index", compact( "products") );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return $this->productService->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( ProductFormRequest $request ) {
        $this->productService->storeProduct( $request );
        return redirect()->route( "product.index" )->with( "message", "Product Created Successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id ) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( int $id ) {
        return $this->productService->editProduct( $id );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( ProductFormRequest $request, int $id ) {
        $this->productService->updateProduct( $request, $id );
        return redirect()->route( "product.index" )->with( "message", "Product Updated Sucessfully" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( int $id) {
        $this->productService->deleteProduct( $id );
        return redirect()->back()->with( "message", "Product deleted successfully" );
    }

    public function deleteImage( int $product_image_id ) {
        $this->productService->deleteImage( $product_image_id );
        return redirect()->back()->with( "message", "Product Image Deleted" );
    }
}
