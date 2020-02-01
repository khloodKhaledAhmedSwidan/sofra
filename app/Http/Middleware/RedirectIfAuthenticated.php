<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            switch ($guard){
                case 'site_client':
                    return redirect()->route('client.profilePage');
                    break;
                case 'site_restaurant':
                    return redirect()->route('restaurant-products.index');
                    break;
                case 'web':
                    return redirect('/admin/home');
                    break;

            }

      //      return redirect('/home');
        }

        return $next($request);
    }
}
