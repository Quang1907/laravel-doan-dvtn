<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\PostService;

class HomeController extends Controller
{
    private $categorySerice = null;
    private $postService = null;

    public function __construct( CategoryService $categorySerice, PostService $postService )
    {
        $this->categorySerice = $categorySerice;
        $this->postService = $postService;
    }

    public function home() {
        return view( "client.index" );
    }

    public function activity() {
        $category = $this->categorySerice->categortPost();
        return view( "client.activity", compact( "category" ) );
    }

    public function post( $slug ) {
        $post = $this->postService->slugPost( $slug );
        return view( "client.post", compact( "post" ) );
    }

    public function account() {
        return view( "client.profile" );
    }
}
