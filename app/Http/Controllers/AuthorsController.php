<?php

namespace App\Http\Controllers;

use App\Services\AuthorsService;
use App\Services\ComicsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class AuthorsController extends Controller
{
    /**
     * @var authorsService
     */
    protected $authorsService;

    /**
     * Constructor
     *
     * @param AuthorsService $authorsService
     */
    public function __construct(AuthorsService $authorsService)
    {
        $this->authorsService = $authorsService;
    }

    public function list()
    {
        try {
            $result = [
                'status' => 200,
                'result' => $this->authorsService->getAll()
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
