<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorComics extends Model
{
    protected $table = 'author_comics';

    protected $primaryKey = ['author_id', 'comic_id'];

    protected $fillable = ['author_id', 'comic_id'];
}
