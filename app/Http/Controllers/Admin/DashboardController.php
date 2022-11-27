<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $totalProducts = Product::count();
        $totalPosts = Post::count();

        $dateNow = Carbon::now()->format( "Y-m-d" );
        $dateMonth = Carbon::now()->format( "m" );
        $dateYear = Carbon::now()->format( "Y" );

        $totalOrders = Order::count();
        $todayOrders = Order::whereDate( "created_at", $dateNow )->count();
        $monthOrders = Order::whereMonth( "created_at", $dateMonth )->count();
        $yearOrders = Order::whereYear( "created_at", $dateYear )->count();

        $allUsers = User::where( "manager", auth()->user()->id )->count();
        $totalAdmin = User::where( "admin", 1 )->where( "manager", auth()->user()->id )->count();
        $totalUser = User::where( "admin", 0 )->where( "manager", auth()->user()->id )->count();

        return view( "admin.index", compact( "totalOrders", "totalProducts", "yearOrders", "monthOrders", 'todayOrders', "totalPosts", "allUsers", "totalAdmin", "totalUser" ) );
    }
}
