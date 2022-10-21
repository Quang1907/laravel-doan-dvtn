<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    protected $userService = null;
    public function __construct( UserService $userService )
    {
        $this->userService = $userService;
    }

    public function index() {
        $users = $this->userService->allManager();

        $eventArr = array();
        $findUserCreate = DB::table("users_events")->where("user_create", "=", auth()->user()->id )->get()->unique( "event_id" );
        foreach ( $findUserCreate as $key => $value ) {
            array_push($eventArr, $value->event_id);
        }
        $bookings = Event::whereIn("id", $eventArr)->get( [ "id", "title", "start", "content", "end" ] );

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
                "content" =>  $booking->content,
                "start" =>  $booking->start,
                "end" =>  $booking->end,
                "color" => $color,
                "textColor" => $textColor,
            ];
        }

        return view( "admin.schedule.calendar", compact( 'events', "users" ) );
    }

    public function store( Request $request ) {
        $request->validate( [
            "title" => "required",
            "user_id" => "required",
            "content" => "required",
        ] );

        $booking = Event::create( $request->all() );
        $listUser = $request->user_id;
        foreach ( $listUser as $id ) {
            if ( $id != 0 ) {
                DB::table( "users_events" )->insert( [
                    "user_id" => $id,
                    "user_create" => auth()->user()->id,
                    "event_id" => $booking->id,
                ] );
            } else {
                $users = $this->userService->allManager();
                foreach ( $users as $user ) {
                    DB::table( "users_events" )->insert( [
                        "user_id" => $user->id ,
                        "user_create" => auth()->user()->id,
                        "event_id" => $booking->id,
                    ] );
                }
            }
        }

        $textColor = null;
        $color = null;

        if ( $booking->title == "quang" ) {
            $color = "red";
            $textColor = "yellow";
        }

        return response()->json(
            [
                "id" => $booking->id,
                "title" =>  $booking->title,
                "start" =>  $booking->start,
                "content" =>  $booking->content,
                "end" =>  $booking->end,
                "color" => $color,
                "textColor" => $textColor,
            ]
         );
    }

    public function update( Request $request, $id ) {
        $booking = Event::find( $id );
        if ( !$booking ) {
            return response()->json( "Unable to locate the event", 404);
        }
        $booking->update( $request->all() );
        return response()->json( "Event updated!" );
    }

    public function destroy( $id ) {
        $booking = Event::find( $id );

        if ( !$booking ) {
            return response()->json( "Unable to locate the event", 404);
        }
        $booking->delete();
        return $id;
    }

    public function timekeeping(){
        $eventArr = array();
        $findUserCreate = DB::table("users_events")->where("user_create", "=", auth()->user()->id )->get()->unique( "event_id" );
        foreach ( $findUserCreate as $key => $value ) {
            array_push($eventArr, $value->event_id);
        }
        $events = Event::whereIn("id", $eventArr)->get( [ "id", "title", "start", "content", "end" ] );
        return view( "admin.schedule.timekeeping", compact( "events" ) );
    }
    public function showEvent( Event $event ) {
        $users = DB::table( "users_events as u_e" )->where( "event_id", $event->id )->join( "users as u", "u.id", "=", "u_e.user_id" )->get( ["u_e.active", "u.email", "u.name","u.email"] );
        return view( "admin.schedule.show", compact( "users", "event" ) );
    }
}
