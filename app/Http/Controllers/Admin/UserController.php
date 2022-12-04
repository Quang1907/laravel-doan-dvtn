<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserEvents;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService = null;

    public function __construct( UserService $userService) {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $this->authorize( "view", new User );
        $users = $this->userService->listUser();
        return view("admin.user.index", compact("users") );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $this->authorize( "create", new User );
        $roles = Role::all();
        return view( "admin.user.create", compact( "roles" ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( CreateUserRequest $request ) {
        return $this->userService->createUser( $request );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( User $user ) {
        $events = UserEvents::where( "user_id", $user->id )->count();
        $participate = UserEvents::where( "user_id", $user->id )->where( "active", true )->count();
        $notEngaged = UserEvents::where( "user_id", $user->id )->where( "active", false )->where( "refuse", false )->count();

        $eventArr = [ $events, $participate, $notEngaged ];

        $refuce =  UserEvents::where( "user_id", $user->id )->where( "refuse", true )->where( "allow_absence", 2 )->count();
        $allow_absence =  UserEvents::where( "user_id", $user->id )->where( "refuse", true )->where( "allow_absence", true )->count();
        $absentArr = [ $allow_absence, $refuce ];

        $rank = number_format( ( ( $participate * 100  ) / $events ), 2 );

        return view( "admin.user.detail", compact( "user", "eventArr", "absentArr", "rank" ) );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        $this->authorize( "update", new User );
        $roles = Role::all();
        return view( "admin.user.edit", compact( "user", "roles") );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  intUser $user
     * @return \Illuminate\Http\Response
     */
    public function update( UpdateUserRequest $request, User $user) {
        $request[ 'admin' ] = ( $request->role_id == config( "admin.role.role_id" ) ) ? false : true ;
        $user->update( $request->all() );
        return back()->with( "message", "User Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        $this->authorize( "delete", new User );
        $user->delete();
        return redirect()->route( "user.index" )->with( "message", "User Updated Successfully");
    }

    public function active( Request $request ) {
        return $this->userService->active( $request );
    }

    public function softDelete( $user ) {
        $this->userService->softDelete(  $user );
        return back();
    }

    public function restoreDelete( $user ) {
        $this->userService->restoreDelete(  $user );
        return back();
    }
}
