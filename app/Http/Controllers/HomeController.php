<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;

class HomeController extends Controller
{
    private $categorySerice = null;

    public function __construct( CategoryService $categorySerice )
    {
        $this->categorySerice = $categorySerice;
    }

    public function home() {
        return view( "client.index" );
    }

    public function activity() {
        $category = $this->categorySerice->categortPost();
        return view( "client.activity", compact( "category" ) );
    }

    public function account() {
        return view( "client.profile" );
    }
}
