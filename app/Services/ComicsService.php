<?php

namespace App\Services;

use App\Repositories\AuthorComicsRepository;
use App\Repositories\AuthorsRepository;
use App\Models\Authors;
use App\Repositories\ComicsRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class ComicsService
{
    /**
     * @var $comicsRepository
     */
    protected $comicsRepository;

    /**
     * @var $MarvelService
     */
    protected $marvelService;

    /**
     * @var $authorComicsRepository
     */
    protected $authorComicsRepository;

    /**
     * AuthorsService constructor.
     *
     * @param ComicsRepository $comicsRepository
     */
    public function __construct(ComicsRepository $comicsRepository, MarvelService $marvelService, AuthorComicsRepository $authorComicsRepository)
    {
        $this->comicsRepository = $comicsRepository;
        $this->marvelService = $marvelService;
        $this->authorComicsRepository = $authorComicsRepository;
    }

    /**
     * Get Authors Data from Marvel Service
     *
     * @param $authorId
     * @return array
     */
    public function getComicsData($authorId)
    {
        try {
            $result = $this->marvelService->callEndpoint("http://gateway.marvel.com/v1/public/creators/" . $authorId . "/comics");

            $output = json_decode($result, true);

            foreach ($output['data']['results'] as $data)
            {
                $this->comicsRepository->save($data);
                $this->authorComicsRepository->save($authorId , $data['id']);
            }

            return $output['data']['results'];
        } catch (Exception $e) {
            return [
                'status' => 500,
                'error' => $e->getMessage()
            ];

        }

    }

    /**
     * Get comics by id.
     *
     * @param $authorId
     * @return mixed
     */
    public function getById($authorId)
    {
        $comics = $this->authorComicsRepository->getByAuthorId($authorId);

        $comicsList = [];

        foreach ($comics as $comic)
        {
            $comicsList[] = $this->comicsRepository->getById($comic->getAttributes()['comic_id']);
        }
        return $comicsList;
    }

}
