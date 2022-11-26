<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy( "created_at", "desc" )->filter()->paginate( 5 );
        return view( "admin.order.index", compact( "orders" ) );
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( Order $order )
    {
        return view( "admin.order.show", compact( "order" ) );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order )
    {
        if ( !empty( $request->status ) ) {
            $order->update( ["status_message" => $request->status ] );
            Alert::toast( "Cap nhat thanh cong", "success" );
            return redirect()->route( "orders.index" );
        } else {
            Alert::toast( "Vui lòng kiểm tra lại", "info" );
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function viewInvoice( $id )
    {
        $order =  Order::findOrFail( $id );
        return view( "client.invoice.generate-invoice", compact( "order" ) );
    }

    public function generateInvoice( $id )
    {
        $order =  Order::findOrFail( $id );
        $data = [ "order" => $order ];
        Pdf::setOption(['defaultFont' => 'sans-serif']);
        $pdf = Pdf::loadView('client.invoice.generate-invoice', $data );
        $today = Carbon::now()->format( "d-m-Y" );
        return $pdf->download('invoice-'. $order->id .'-'. $today .'.pdf');
    }
}
