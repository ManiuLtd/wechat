<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        $value = $request->session()->get('admin', 'noauth');
        if($value == 'noauth'){
            return redirect()->route('login.login');
        }
        return $next($request);
    }
}
