<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->get();
        return Inertia::render('Backend/Order/Order', compact('orders'));
    }
    public function edit($id)
    {
//        return $id;
//        $order = Order::where('id', $id)->with('user', 'address')->first();
        $order = Order::where('id', $id)
            ->with('user')
            ->with('address' , function($query) { $query->withTrashed(); })
            ->first();
        $orderDetails = OrderDetail::where('order_id', $id)
            ->with('product' , function($query) { $query->withTrashed(); })
            ->get();
        $user_total_pay = Order::where('user_id', $order->user->id)->sum('total_price');
        $user_total_pay = number_format($user_total_pay, 2, ',', '.');
        return Inertia::render('Backend/Order/OrderDetail', compact('orderDetails', 'order', 'user_total_pay'));
    }
}
