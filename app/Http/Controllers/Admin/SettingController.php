<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{

    public function setting() {
        $setting = Setting::first();
        return view( "admin.setting.index", compact( "setting" ) );
    }

    public function store( Request $request ) {
        $setting = Setting::first();
        if ( $setting ) {
            // update
            $setting->update( request()->all() );
        } else {
            // create
            Setting::create( request()->all() );
        }
        Alert::toast( "Cập nhật thành công.", "success" );
        return redirect()->back();
    }
}
