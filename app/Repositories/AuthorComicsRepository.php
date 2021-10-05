<?php

namespace App\Repositories;

use App\Models\AuthorComics;

class AuthorComicsRepository
{
    /**
     * @var AuthorComics
     */
    protected $authorComics;

    /**
     * AuthorComicsRepository constructor.
     *
     * @param AuthorComics $authorComics
     */
    public function __construct(AuthorComics $authorComics)
    {
        $this->authorComics = $authorComics;
    }

    /**
     * Get all author comics.
     *
     * @return AuthorComics $comics
     */
    public function getAll()
    {
        return $this->authorComics
            ->get();
    }

    /**
     * Get comic by author id
     *
     * @param $Id
     * @return mixed
     */
    public function getByAuthorId($Id)
    {
        return $this->authorComics
            ->where('author_id', $Id)
            ->get();
    }

    /**
     * Save Author Comic
     *
     * @param $data
     * @return AuthorComics
     */
    public function save($authorId, $comicId)
    {
        $data['author_id'] =  $authorId;
        $data['comic_id'] =  $comicId;

        return AuthorComics::insertOrIgnore($data);
    }
}
