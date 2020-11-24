<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class clienteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard='cliente')
    {
        
        if (!Auth::guard($guard)->check()) {
            $path = $request->path();
            return redirect()->route('ingresar');
        }
        return $next($request);
       
        // 
    }
}
