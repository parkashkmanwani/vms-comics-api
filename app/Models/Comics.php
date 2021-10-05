<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comics extends Model
{
    protected $table = 'comics';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'title', 'series_name', 'description','page_count','thumbnail_url'];
}
