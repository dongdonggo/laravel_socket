<?php

namespace App\Http\Middleware;

use Closure;

class adminOuth
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

        $admin = session('admin');
        if (!$admin ) {
            return redirect('/auth/login');
        }
        $request->admin =json_decode($admin) ;
        return $next($request);
    }
}
