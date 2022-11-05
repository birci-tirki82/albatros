<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AccountController extends Controller
{
    public function account()
    {
        $user = Auth::user();
        if ($user){
            return Inertia::render('Frontend/Account', compact('user'));
        } else {
            return Inertia::render('Frontend/Login');
        }

    }

    public function userUpdate(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->save();
        return Inertia::render('Frontend/Account', compact('user'));
    }

    public function orderHistory()
    {
//        return 1;
        $user = Auth::user();
        $orderDetails = [];
        if ($user){
            $order = Order::where('user_id', $user->id)
                ->with('address' , function($query) { $query->withTrashed(); })
                ->get();
            if ($order){
                foreach ($order as $item){
                    $orderDetails[] = OrderDetail::where('order_id', $item->id)
                        ->with('product' , function($query) { $query->withTrashed(); })
                        ->first();
                }
            }
//            return $orderDetails;
//            if ($order)
//            $orderDetails = OrderDetail::where('order_id', $order->id)->with('product')->get();
            return Inertia::render('Frontend/OrderHistory', compact('user', 'order', 'orderDetails'));
        } else {
            return Inertia::render('Frontend/Login');
        }
    }
}
