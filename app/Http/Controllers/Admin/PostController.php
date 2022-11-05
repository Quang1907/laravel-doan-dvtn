<?php

namespace App\Http\Controllers\Admin;

use App\Exports\PostExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Models\Post;
use App\Services\CategoryService;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{

    private $postService = null;
    private $categoryService = null;

    public function __construct( PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->paginationPost();
        $categories =  $this->categoryService->allCategory();
        return view("admin.post.index", compact( "posts", "categories" ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize("create", Post::class );
        $categories = $this->categoryService->allCategory();
        return view("admin.post.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( CreatePostRequest $request)
    {
        $this->postService->createPost( $request );
        return redirect()->route("post.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $this->authorize("view", $post);
        return view("admin.post.show" , compact( "post" ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize("update", $post);
        $categories = $this->categoryService->allCategory();
        return view("admin.post.edit", compact("post", "categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update( UpdatePostRequest $request, Post $post)
    {
        $this->authorize( "update", $post );
        $this->postService->updatePost( $request, $post );
        return redirect()->route( "post.index" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize("delete", $post );
        $this->postService->deletePost( $post );
        return back();
    }

    public function uploadFile( Request $request ) {
        $this->postService->uploadFile( $request );
        return back();
    }

    public function exportFile() {
        return Excel::download( new PostExport, "posts.xlsx" );
    }
}
