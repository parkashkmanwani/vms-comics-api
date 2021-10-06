<?php

namespace App\Http\Controllers;

use App\Services\AuthorsService;
use App\Services\ComicsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class ComicsController extends Controller
{
    /**
     * @var comicsService
     */
    protected $comicsService;

    /**
     * Constructor
     *
     * @param ComicsService $comicsService
     */
    public function __construct(ComicsService $comicsService)
    {
        $this->comicsService = $comicsService;
    }

    public function get($authorId)
    {
        try {
            $result = [
                'status' => 200,
                'result' => $this->comicsService->getById($authorId)
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
