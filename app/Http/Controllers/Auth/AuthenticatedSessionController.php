<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
       $request->authenticate();

        if (!empty(session('cart'))) {
            if (Auth::user()) {
                $user_id = Auth::user()->getAuthIdentifier();
                $carts = Cart::where('user_id', $user_id)->get();
                if (count($carts) != 0) {
                    foreach (session('cart.products') as $session) {
                        $sayac=0;
                        foreach ($carts as $cart) {
                            if ($session->id == $cart->product_id) {
                                $sayac++;
                                $singleCart = Cart::where('product_id', $cart->product_id)->where('user_id', $user_id)->first();
                                $singleCart->count = $cart->count + $session->qty;
//                                $singleCart->total_price = $cart->total_price + $session->total_price;
                                $singleCart->save();
                            }
                        }
                        if ($sayac == 0) {
                            Cart::create([
                                'user_id' => $user_id,
                                'product_id' => $session->id,
                                'count' => $session->qty,
//                                'total_price' => $session->total_price
                            ]);
                        }
                    }
                }
                else {
                    foreach (session('cart.products') as $session) {
                        Cart::create([
                            'user_id' => $user_id,
                            'product_id' => $session->id,
                            'count' => $session->qty,
//                            'total_price' => $session->total_price
                        ]);
                    }
                }
            }
//            return session()->all();
            $request->session()->regenerate();
            return redirect()->route('/');
        } else {
//            return 1;
//            return redirect()->route('admin');
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
//        return "olmadı";
        Auth::guard('web')->logout();
//        return 1;
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/user-login');
    }

    public function admin_destroy(Request $request)
    {
//        return "oldu";
        Auth::guard('web')->logout();
//        return 1;
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
