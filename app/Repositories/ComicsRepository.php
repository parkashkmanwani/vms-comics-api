<?php

namespace App\Repositories;

use App\Models\Comics;
use Carbon\Carbon;

class ComicsRepository
{
    /**
     * @var Comics
     */
    protected $comics;

    /**
     * ComicsRepository constructor.
     *
     * @param Comics $comics
     */
    public function __construct(Comics $comics)
    {
        $this->comics = $comics;
    }

    /**
     * Get all comics.
     *
     * @return Comics $comics
     */
    public function getAll()
    {
        return $this->comics
            ->get();
    }

    /**
     * Get comic by id
     *
     * @param $Id
     * @return mixed
     */
    public function getById($comicId)
    {
        return $this->comics
            ->where('id', $comicId)
            ->get();
    }

    /**
     * Save Comic
     *
     * @param $data
     * @return Comics
     */
    public function save($data)
    {
        $comic['id'] =  $data['id'];
        $comic['title'] =  $data['title'];
        $comic['series_name'] =  $data['series']['name'];
        $comic['description'] =  $data['description'];
        $comic['page_count'] =  $data['pageCount'];
        $comic['thumbnail_url'] =  $data['thumbnail']['path'].'.'.$data['thumbnail']['extension'];
        $comic['created_at'] = Carbon::now();
        return Comics::insertOrIgnore($comic);
    }
}
