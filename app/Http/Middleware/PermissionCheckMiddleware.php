<?php

namespace App\Http\Middleware;

use Closure;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as Session;

class PermissionCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // $manager->user()->manager_id;

        $user = Auth::user();

        foreach ($roles as $role) {

            if($role == 'manager')

                if(isset($user->manager_id)){

                $data = [
                    'manager' => true
                ];
                $request->session()->put($data);

                return $next($request);

                } else {

                // Session::flash('error', 'Acesso negado');
                return redirect('/');

            }

            if($role == 'employee')

                if(isset($user->employee_id)){

                $data = [
                    'employee' => true
                ];
                $request->session()->put($data);

                return $next($request);

            } else if(isset($user->manager_id)){

                $data = [
                    'manager' => true
                ];
                $request->session()->put($data);

                return $next($request);

                } else {

                return back()->with(Session::flash('error', 'Acesso negado, voce nao é um funcionario'));

                }

            if ($role == 'customer') {

                if (isset($user->customer_id)) {
                    $data = [
                        'customer' => true
                    ];

                    if ($user->customer->is_new && !$request->is('person/'.$user->customer->person_id.'/edit') && !$request->rg) {
                        return redirect('person/'.$user->customer->person_id.'/edit');
                    }

                    $request->session()->put($data);

                    return $next($request);

                } else if (isset($user->manager_id)) {

                    $data = [
                        'manager' => true
                    ];

                    $request->session()->put($data);

                    return $next($request);

                } else if (isset($user->employee_id)) {

                    $data = [
                        'employee' => true
                    ];

                    $request->session()->put($data);

                    return $next($request);

                } else {

                    return back()->with(Session::flash('error', 'Acesso negado, voce nao é um cliente'));
                }
            }
            return $next($request);
        }
    }
}








