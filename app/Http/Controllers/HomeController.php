<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Slider;
use App\Services\CategoryPostService;
use App\Services\CategoryProductService;
use App\Services\PostService;
use App\Services\ProductService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $categorySerice = null;
    private $postService = null;
    private $productService = null;
    private $categoryProductService = null;

    public function __construct (
        CategoryPostService $categorySerice,
        PostService $postService,
        ProductService $productService,
        CategoryProductService $categoryProductService )
    {
        $this->categorySerice = $categorySerice;
        $this->postService = $postService;
        $this->productService = $productService;
        $this->categoryProductService = $categoryProductService;
    }

    public function home() {
        return view( "client.index" );
    }

    // post by category or all post
    public function categoryPost( $slug = null ) {
        $sliders = Slider::where( "status", true )->get();

        if ( !empty( $slug ) ) {
            $slugCategory = $this->categorySerice->categoryPost( $slug );
            return view( "client.activity", compact( "slugCategory", "sliders" ) );
        }

        $posts = $this->postService->allPost();
        return view( "client.activity", compact( "posts", "sliders" ) );
    }

    // show post detail
    public function viewPost( $slugPost ) {
        $post = $this->postService->slugPost( $slugPost );
        return view( "client.post", compact( "post" ) );
    }

    // all products
    public function shop() {
        $trendingProducts = $this->productService->trendingProducts();
        $products = $this->productService->allProduct();
        $allCategoryProducts = $this->categoryProductService->allCateProduct();
        $brands = Brand::all();
        $colors = Color::all();
        return view( "client.shop", compact( "trendingProducts", "products", "allCategoryProducts", "brands", "colors"  ) );
    }

    // products by category
    public function categoryProducts( $slug ){
        $trendingProducts = $this->productService->trendingProducts(); // product trending
        $categoryProduct  = $this->categoryProductService->categorySlug( $slug ); // show category product
        $allCategoryProducts = $this->categoryProductService->allCateProduct(); // show category list
        $colors = Color::all();
        return view( "client.product", compact( 'trendingProducts', "categoryProduct", "allCategoryProducts", "colors" ) );
    }

    // show product detail
    public function viewProduct( $slugCate, $slugProduct ) {
        $product = $this->productService->whereSlug( $slugProduct );
        return view( "client.product-detail", compact( "slugCate", "slugProduct", "product" ) );
    }

    public function account() {
        return view( "client.profile" );
    }

    public function calendar() {
        $eventArr = array();
        $bookings = DB::table( "users_events" )->join( "events", "event_id", "id" )->where( "user_id", auth()->user()->id )->get();
        $events = array();

        foreach ( $bookings as $booking ) {
            $color = null;
            $textColor = null;

            if ( check_time_end ( $booking->end ) )  {
                if ( $booking->active == false ) {
                    $color = "red";
                    $textColor = "yellow";
                } else {
                    $color = "green";
                    $textColor = "yellow";
                }
            } else {
                $now = Carbon::now();
                if ( $now->between( $booking->start, $booking->end ) ) {
                    $color = "yellow";
                    $textColor = "red";
                }else {
                    $color = "blue";
                    $textColor = "yellow";
                }
            }

            $events[] = [
                "id" => $booking->id,
                "title" =>  $booking->title,
                "start" =>  $booking->start,
                "content" =>  $booking->content,
                "end" =>  $booking->end,
                "color" => $color,
                "textColor" => $textColor,
                "active" => $booking->active,
            ];
        }
        return view( "client.calendar", compact( 'events' ) );
    }
}
