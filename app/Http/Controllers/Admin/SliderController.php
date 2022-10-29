<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::paginate( 10 );
        return view( "admin.slider.index", compact( "sliders" ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( "admin.slider.action" );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( SliderFormRequest $request )
    {
        $request[ 'image' ] = str_replace(  $request->root() ,"", $request->image );
        $request[ 'status' ] = ( $request->status == "on" ) ? true : false;
        Slider::create( $request->all() );
        return redirect()->route( "slider.index" )->with( "message", "Slider Created Successfully" );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider  = Slider::findOrFail( $id );
        return view( "admin.slider.action", compact( "slider" ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( SliderFormRequest $request, $id)
    {
        $slider = Slider::findOrFail( $id );
        $request[ 'image' ] = str_replace(  $request->root() ,"", $request->image );
        $request[ 'status' ] = ( $request->status == "on" ) ? true : false;
        $slider->update( $request->all() );
        return redirect()->route( "slider.index" )->with( "message", "Slider Updated Successfully" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail( $id );
        $slider->delete();
        return redirect()->route( "slider.index" )->with( "message", "Slider Deleted Successfully" );
    }
}
