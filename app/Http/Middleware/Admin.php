<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
//        return 1;
            if (auth()->check()){ //if içine yazdığımız zincir method kullanıcının giriş yapıp yapmadığını gösteriyor. Giriş yapılmışsa true, yapılmamış ise false döndürür.
                $roles = auth()->user()->roles()->get();
//                dd($roles);
                foreach ($roles as $role){
                    if ($role->name==='admin')
                        return $next($request);
                    else
//                        return 1;
                        return redirect('/');
                }
            }
        return redirect('/');
    }
}
