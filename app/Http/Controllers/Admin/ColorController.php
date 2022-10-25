<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Color\ColorFormRequest;
use App\Models\Color;

class ColorController extends Controller
{
 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::orderBy( "id", "DESC" )->paginate( 5 );
        return view( "admin.color.index", compact( "colors" ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( "admin.color.action" );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( ColorFormRequest $request)
    {
        $request[ 'status' ] = ( $request->status == "on" ) ? true : false;
        Color::create( $request->all() );
        return redirect()->route( "color.index" )->with( "message", "Color Created Successfully" );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show( Color $color )
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit( Color $color )
    {
        return view( "admin.color.action", compact( "color" ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update( ColorFormRequest $request, Color $color)
    {
        $request[ 'status' ] = ( $request->status == "on" ) ? true : false;
        $color->update( $request->all() );
        return redirect()->route( "color.index" )->with( "message", "Color Updated Successfully" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy( Color $color )
    {
        $color->delete();
        return redirect()->route( "color.index" )->with( "message", "Color Deleted Successfully" );
    }
}
