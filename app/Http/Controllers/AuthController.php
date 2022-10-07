<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ChangeInfoRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Requests\AuthRequest;
use App\Services\UserService;

class AuthController extends Controller
{
    private $userService = null;

    public function __construct( UserService $userService ) {
        $this->userService = $userService;
    }

    public function create() {
        return view( "client.auth.register" );
    }

    public function store( UserRegisterRequest $request ) {
        $this->userService->register( $request );
        return redirect()->route( "home" );
    }

    public function password( ChangePasswordRequest $request ) {
        return $this->userService->updatePassword( $request );
    }

    public function checkLogin( AuthRequest $request ) {
        return $this->userService->checkLogin( $request );
    }

    public function info( ChangeInfoRequest $request ) {
        $this->userService->updatetInfo( $request );
        return redirect()->route( "profile" );
    }
}
