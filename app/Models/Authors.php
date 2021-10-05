<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Authors extends Model
{
    protected $table = 'authors';

    protected $primaryKey = 'id';

    protected $fillable = ['id', 'first_name', 'last_name', 'thumbnail_url'];
}
