<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeMiddleware
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
            //user role == 2

            // dd('ola');

            if(Auth::user()->role == 0  ) {

                if (Auth::user()->employee->is_new == true && !$request->is('employees/'.Auth::user()->employee->id.'/edit')) {

                    // dd('oi');
                    return redirect('/employees/'.Auth::user()->employee->id.'/edit');

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
