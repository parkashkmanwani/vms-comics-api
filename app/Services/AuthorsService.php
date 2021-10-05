<?php

namespace App\Services;

use App\Repositories\AuthorsRepository;
use App\Models\Authors;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class AuthorsService
{
    /**
     * @var $authorsRepository
     */
    protected $authorsRepository;

    /**
     * @var $MarvelService
     */
    protected $marvelService;

    /**
     * AuthorsService constructor.
     *
     * @param AuthorsRepository $authorsRepository
     */
    public function __construct(AuthorsRepository $authorsRepository, MarvelService $marvelService)
    {
        $this->authorsRepository = $authorsRepository;
        $this->marvelService = $marvelService;
    }

    /**
     * Get Authors Data from Marvel Service
     *
     * @param $limit
     * @return array
     */
    public function getAuthorsData($limit)
    {
        try {
            $result = $this->marvelService->callEndpoint("http://gateway.marvel.com/v1/public/creators", $limit);

            $output = json_decode($result, true);

            foreach ($output['data']['results'] as $data)
            {
                $this->authorsRepository->save($data);
            }

            return $output['data']['results'];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];

        }

    }
}
