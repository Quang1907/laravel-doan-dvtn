<?php

namespace App\Repositories;

use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Province;
use Kjmtrue\VietnamZone\Models\Ward;

class AddressRepository {
    protected $province = null;
    protected $district = null;
    protected $ward = null;

    public function __construct( Province $province, District $district, Ward $ward ) {
        $this->province = $province;
        $this->district = $district;
        $this->ward = $ward;
    }

    public function allProvince( ) {
        return $this->province::all();
    }

    public function findDistrictWithProvince( $province ) {
        return $this->district::where( "province_id", $province )->get();
    }

    public function findWardWithDistrict( $district ) {
        return $this->ward::where( "district_id", $district )->get();
    }
}
