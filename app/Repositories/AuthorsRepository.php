<?php

namespace App\Repositories;

use App\Models\Authors;
use Carbon\Carbon;

class AuthorsRepository
{
    /**
     * @var Authors
     */
    protected $authors;

    /**
     * AuthorsRepository constructor.
     *
     * @param Authors $authors
     */
    public function __construct(Authors $authors)
    {
        $this->authors = $authors;
    }

    /**
     * Get all authors.
     *
     * @return Authors $authors
     */
    public function getAll()
    {
        return $this->authors
            ->get();
    }

    /**
     * Get author by id
     *
     * @param $Id
     * @return mixed
     */
    public function getById($Id)
    {
        return $this->authors
            ->where('id', $Id)
            ->get();
    }

    /**
     * Save Author
     *
     * @param $data
     * @return bool
     */
    public function save($data)
    {
        $author['id'] =  $data['id'];
        $author['first_name'] =  $data['firstName'];
        $author['last_name'] =  $data['lastName'];
        $author['thumbnail_url'] =  $data['thumbnail']['path'].'.'.$data['thumbnail']['extension'];
        $author['created_at'] = Carbon::now();
        return Authors::insertOrIgnore($author);
    }
}
