<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\UserRegisterRequest;
use App\Http\Requests\AuthRequest;
use App\Services\UserService;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    private $userService = null;

    public function __construct( UserService $userService ) {
        $this->userService = $userService;
    }

    public function checkLogin( AuthRequest $request ) {
        return $this->userService->checkLogin( $request );
    }

    public function register() {
        return view( "auth.register" );
    }

    public function store( UserRegisterRequest $request ) {
        $this->userService->register( $request );
        Alert::toast('Vui lòng đợi. Tài khoản của bạn sẽ được duyệt sau ít phút.', 'success');
        return redirect()->route("/");
    }
}
