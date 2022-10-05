<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ApiUserManagerController extends Controller
{
    public function admin( Request $request ) {
        return User::where( "admin" , true )->where( "address", "like", "%". $request->address . "%" )->get();
    }
}
