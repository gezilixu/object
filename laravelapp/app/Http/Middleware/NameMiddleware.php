<?php

namespace App\Http\Middleware;

use Closure;

class NameMiddleware
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
        if(empty($_SESSION)){
            return redirect()->route('login');
            return $next($request);
        }else{
            return redirect()->route('loginsuccess');
        }

    }
}
