<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class BackendController extends Controller
{
    public function index()
    {
//        return 1;
        $order_count = Order::all()->count();
        $order_total_price = Order::sum('total_price');
        $order_total_price = number_format($order_total_price, 2, ',', '.');
        $total_user = User::all()->count();
        $todayOrder = Order::whereDate('created_at',today())->count();
        $todaySale = Order::whereDate('created_at',today())->sum('total_price');
        $todayUser = User::whereDate('created_at',today())->count();
        return Inertia::render('Backend/HomeView', compact(
            'order_count',
            'order_total_price',
            'total_user',
            'todayOrder',
            'todaySale',
            'todayUser',
        ));
    }
}
