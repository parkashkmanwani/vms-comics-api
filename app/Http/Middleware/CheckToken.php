<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckToken
{

    public function __construct()
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if ($token == 'foo_bar')
        {
            return $next($request);
        }
        $result = [
            'status' => 404,
            'error' => "Invalid Token Provided"
        ];
        return response()->json($result, $result['status']);
    }
}
