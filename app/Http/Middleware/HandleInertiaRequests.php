<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
//    protected $rootView = 'app';

    public function rootView(Request $request)
    {
//        return $request;
        if(request()->is('admin/*') or request()->is('admin') or request()->is('login'))
        {
            return 'app';
        }
        return 'welcome';
//        return parent::rootView($request);
    }

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $qty = 0;
        $favqty = 0;
        $categories = Category::where('is_active', 1)->limit(5)->get();
        $mainCats = Category::where('parent_id', 0)->get();
        if(auth()->user()){
            $cartdata = Cart::where('user_id', auth()->user()->getAuthIdentifier())->get();
            $favdata = Favorite::where('user_id', auth()->user()->getAuthIdentifier())->get();
            $favqty = count($favdata);
            foreach ($cartdata as $value){
                $qty += $value->count;
            }
        } else {
            if (!empty(session('cart.total'))){
                $qty = session('cart.total');
            }
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            'cart' => [
                'qty' => $qty,
            ],
            'favorite' => [
                'favqty' => $favqty,
            ],
            'menucats' => [
                'menucats' => $categories,
            ],
            'mainCats' => [
                'mainCats' => $mainCats,
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
        ]);
    }
}
