<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\CategoryPostService;

class CategoryPostController extends Controller
{
    private $categories = null;

    public function __construct( CategoryPostService $categories ) {

        $this->categories = $categories;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categories->paginationCategory();
        return view( 'admin.category.post.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categories->allCategory();
        return view( 'admin.category.post.create' , compact( "categories" ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( CreateCategoryRequest $request )
    {
        $this->categories->create( $request );
        return redirect()->route( "category-posts.index" )->with( "message", "Category Created Successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        $category = $this->categories->findCategoryPost( $id );
        return view( "admin.category.post.show", compact( "category" ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $category = $this->categories->findCategoryPost( $id );
        $categories = $this->categories->allCategory();
        return view( 'admin.category.post.edit', compact( "category", "categories" ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateCategoryRequest $request, $id )
    {
        $category = $this->categories->findCategoryPost( $id );
        $this->categories->update( $request, $category );
        return redirect()->route( "category-posts.index" )->with( "message", "Category Updated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        $category = $this->categories->findCategoryPost( $id );
        $this->categories->delete( $category );
        return redirect()->route( "category-posts.index" );
    }
}
