<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Order;
use App\Models\Slider;
use App\Models\UserEvents;
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
        $trending_post = $this->postService->trending();
        $allPosts = $this->postService->allPost();
        $popular_posts = $this->postService->popular_post();
        $hot_news = $this->postService->hot_news();
        return view( "client.index", compact( "trending_post", "allPosts", "hot_news", "popular_posts" ) );
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
        return view( "client.product.shop", compact( "trendingProducts", "products", "allCategoryProducts", "brands", "colors"  ) );
    }

    // products by category
    public function categoryProducts( $slug ){
        $trendingProducts = $this->productService->trendingProducts(); // product trending
        $categoryProduct  = $this->categoryProductService->categorySlug( $slug ); // show category product
        $allCategoryProducts = $this->categoryProductService->allCateProduct(); // show category list
        $colors = Color::all();
        return view( "client.product.index", compact( 'trendingProducts', "categoryProduct", "allCategoryProducts", "colors" ) );
    }

    // wishlist product
    public function wishlistProduct( ) {
        return view( "client.product.product-wishlist" );
    }

    public function cartsProduct() {
        return view( "client.product.product-cart" );
    }

    public function checkout() {
        return view( "client.product.checkout" );
    }

    public function thankYou() {
        return view( "client.thankyou" );
    }

    public function orders() {
        $orders = Order::where( "user_id", auth()->user()->id )->orderBy( "created_at", "desc" )->paginate( 5 );
        return view( "client.product.orders", compact( "orders" ) );
    }

    public function orderDetail( Order $order ) {
        return view( "client.product.order-detail", compact( "order" ) );
    }

    // show product detail
    public function viewProduct( $slugCate, $slugProduct ) {
        $product = $this->productService->whereSlug( $slugProduct );
        return view( "client.product.product-detail", compact( "product" ) );
        // return view( "client.product-detail", compact( "slugCate", "slugProduct", "product" ) );
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
                    if ( $booking->refuse == true  ) {
                        if ( $booking->allow_absence == true ) {
                            $color = "pink";
                            $textColor = "red";
                        }

                        if ( empty( $booking->allow_absence ) ) {
                            $color = "gray";
                            $textColor = "white";
                        }

                        if (  $booking->allow_absence == 2 ) {
                            $color = "rgb(139 92 246)";
                            $textColor = "white";
                        }

                    } else {
                        $color = "blue";
                        $textColor = "yellow";
                    }

                }
            }

            $events[] = [
                "id" => $booking->id,
                "user_id" => $booking->user_id,
                // "refuse" => $booking->refuse,
                // "allow_absence" => $booking->allow_absence,
                "title" =>  $booking->title,
                "start" =>  $booking->start,
                "content" =>  $booking->content,
                "end" =>  $booking->end,
                "color" => $color,
                "textColor" => $textColor,
                "active" => $booking->active,
                "refuse" => $booking->refuse,
            ];
        }
        return view( "client.calendar", compact( 'events' ) );
    }

    public function refuse() {
        $event_id = request()->event_id;
        $user_id = request()->user_id;
        $content_refuse = request()->content_refuse;
        $event = UserEvents::where( "event_id", $event_id )->where( "user_id", $user_id );

        if ( request()->status == "yes" ) {
            $check = UserEvents::where( "user_id", $user_id )->where( "refuse", true )->count();
            if ( $check >= 3 ) {
                return response()->json( [
                    "status" => 404,
                    "message" => "B???n ???? xin v???ng qu?? 3 l???n.",
                ]);
            }
            $event->update([ "refuse" => true, "content_refuse" => $content_refuse ]);
            $message = "Xin v???ng th??nh c??ng";
        } else {
            $event->update([ "refuse" => false, "content_refuse" => $content_refuse ]);
            $message = "Hu??? xin v???ng th??nh c??ng";
        }

        return response()->json( [
            "status" => 202,
            "message" => $message,
        ]);
    }
}
