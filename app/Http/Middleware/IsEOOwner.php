<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;


class IsEOOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::get('id')==Session::get('id_user')) {
            return $next($request);
        } else {
            return redirect()->back()->with('alert', 'Anda tidak memiliki hah untuk akun event organizer ini');
        }
    }
}
