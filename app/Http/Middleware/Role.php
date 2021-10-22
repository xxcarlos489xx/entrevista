<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        $rolUser = $request->user()->rol->tipo;
        if ($rolUser != $role) {
            return redirect('admin/tipo-cambio');
        }
        return $next($request);
    }
}
