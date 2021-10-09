<?php

namespace App\Http\Middleware;

use App\Repositories\ResellerRepository;
use Closure;
use Illuminate\Http\Request;

class CheckReseller
{

    public function __construct(ResellerRepository $resellerRepo)
    {
        $this->resellerRepo = $resellerRepo;
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
        $parameters = $request->route()->parameters();
        if (count($this->resellerRepo->getById($parameters['resellerId'])) == 0) {
            $result = [
                'status' => 404,
                'error' => "Reseller not found"
            ];
            return response()->json($result, $result['status']);
        }
        return $next($request);
    }
}
