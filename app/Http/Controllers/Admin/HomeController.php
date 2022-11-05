<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\CategoryService;
use App\Services\PostService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $categorySerice = null;
    private $postService = null;

    public function __construct( CategoryService $categorySerice, PostService $postService, UserService $userService )
    {
        $this->categorySerice = $categorySerice;
        $this->postService = $postService;
        $this->userService = $userService;
    }

    public function home() {
        return view( "client.index" );
    }

    public function categoryPost( $slug = null ) {
        if ( !empty( $slug ) ) {
            $slugCategory = $this->categorySerice->categoryPost( $slug );
            $sliders = Slider::where( "status", true )->get();
            return view( "client.activity", compact( "slugCategory", "sliders" ) );
        }
        $posts = $this->postService->allPost();
        $sliders = Slider::where( "status", true )->get();
        return view( "client.activity", compact( "posts", "sliders" ) );

    }

    public function viewPost( $slugPost ) {
        $post = $this->postService->slugPost( $slugPost );
        return view( "client.post", compact( "post" ) );
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
