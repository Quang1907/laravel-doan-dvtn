<?php
namespace App\Services;

use App\Repositories\AddressRepository;
use Illuminate\Http\Request;

class AddressService {

    public $addressService = null;

public function __construct( AddressRepository $addressService ) {
        $this->addressService = $addressService;
    }

    public function province() {
        return $this->addressService->allProvince();
    }

    public function district( Request $request ) {
        return $this->addressService->findDistrictWithProvince( $request->province );
    }

    public function ward( Request $request ) {
        return $this->addressService->findWardWithDistrict( $request->district );
    }
}
