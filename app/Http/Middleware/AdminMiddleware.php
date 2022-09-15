<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
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


            if(Auth::user()->manager_id) {

            return $next($request);

            } else {
                Session::flash('error', 'Acesso negado');
                return redirect('/');

            }
        } else {
            Session::flash('error', 'Logar no site');
            return redirect('/login');
        }

        return $next($request);
    }


}
