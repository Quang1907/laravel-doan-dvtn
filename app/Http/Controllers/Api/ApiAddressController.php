<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AddressService;
use Illuminate\Http\Request;

class ApiAddressController extends Controller
{
    protected $addressService = null;
    public function __construct( AddressService $addressService ) {
        $this->addressService = $addressService;
    }

    public function district( Request $request ) {
        return $this->addressService->district( $request );
    }

    public function ward( Request $request ) {
        return $this->addressService->ward( $request );
    }

    public function province() {
         return $this->addressService->province();
    }
}
