<?php

namespace App\Http\Middleware;

use Closure;

class ApiKey
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
        $keyRequest = $request->route('apiKey');
        $apiKey = config('app.apikey');        
        
        if ($apiKey != $keyRequest) {
            $data = [   "status"    =>  401,
                        "message" => 'Acceso denegado',
                    ];

            return response()->json($data, 401);
        }
        return $next($request);
    }
}
