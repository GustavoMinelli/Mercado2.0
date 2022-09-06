<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {

            //employee role == 0
            //admin role == 1
            //customer role == 2


            if(Auth::user()->role == 2  ) {

                if (Auth::user()->customer->is_new == true && !$request->is('customers/'.Auth::user()->customers->id.'/edit')) {

                    // dd('oi');
                    return redirect('/customers/'.Auth::user()->customers->id.'/edit');

                } else{

                    return $next($request);
                }

            }// } else {

            //     return route('login');

            // }
        }

            // return redirect('login');

            return $next($request);

    }
}
