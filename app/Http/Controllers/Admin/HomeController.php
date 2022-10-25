<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\CategoryService;
use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $categorySerice = null;
    private $postService = null;
    private $userService = null;

    public function __construct( CategoryService $categorySerice, PostService $postService, UserService $userService )
    {
        $this->categorySerice = $categorySerice;
        $this->postService = $postService;
        $this->userService = $userService;
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

    public function carousel( Request $request ) {
        $request->validate( ['image' => "required"] );
        $url = explode( ",", $request->image );
        $urlImage = implode( '","', $url);
        $content = '<?php
        return [
            "image" => [
                "' . $urlImage . '"
            ]
        ];';
        file_put_contents( config_path("carousel.php"), $content );
        return back();
    }

    public function calendar() {
        $users = $this->userService->allManager();

        $eventArr = array();
        $bookings = User::find( auth()->user()->id )->showEvent()->get();

        $events = array();

        foreach ( $bookings as $booking ) {
            $color = null;
            $textColor = null;

            if ( $booking->title == "quang" ) {
                $color = "red";
                $textColor = "yellow";
            }

            $events[] = [
                "id" => $booking->id,
                "title" =>  $booking->title,
                "start" =>  $booking->start,
                "content" =>  $booking->content,
                "end" =>  $booking->end,
                "color" => $color,
                "textColor" => $textColor,
            ];
        }
        return view( "client.calendar", compact( 'events', "users") );
    }
}
