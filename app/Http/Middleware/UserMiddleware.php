<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {

        if(Auth::check()) {


            if(Auth::user()->role == 2  ) {

                if (Auth::user()->customer->is_new == true && !$request->is('customers/'.Auth::user()->customer->id.'/edit')) {

                    return redirect('/customers/'.Auth::user()->customer->id.'/edit');

                } else{

                    return $next($request);
                }

            }
        }


            return $next($request);

    }

}



