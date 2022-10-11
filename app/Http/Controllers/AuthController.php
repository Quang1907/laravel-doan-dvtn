<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ChangeInfoRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ConfirmInfoRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $userService = null;

    public function __construct( UserService $userService ) {
        $this->userService = $userService;
    }

    public function register( UserRegisterRequest $request ) {
        $user = $this->userService->register( $request );
        return view( "client.auth.vertify_email", compact( "user" ));
    }

    public function password( ChangePasswordRequest $request ) {
        return $this->userService->updatePassword( $request );
    }

    public function checkLogin( LoginRequest $request ) {
        return $this->userService->checkLogin( $request );
    }

    public function info( ChangeInfoRequest $request ) {
        $this->userService->updatetInfo( $request );
        return redirect()->route( "profile" );
    }

    public function confirm( ConfirmInfoRequest $request, User $user ) {
        $this->userService->confirmInfo( $request, $user );
        return redirect("/");
    }

    public function vertify( Request $request, User $user ) {
        return $this->userService->vertifyEmail( $request, $user);
    }

    public function changeAvata( Request $request, User $user ) {
        return $this->userService->changeAvata( $request, $user );
    }
}
