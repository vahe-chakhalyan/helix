<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = [
        'id', 'title', 'description', 'image_url', 'url', 'date'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
