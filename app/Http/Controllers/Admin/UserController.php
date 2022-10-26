<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
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
        $users = $this->userService->listUser();
        return view("admin.user.index", compact("users") );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
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
    public function show(User $user) {
        return view( "admin.user.show", compact( "user") );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
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
