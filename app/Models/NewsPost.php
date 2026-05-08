<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsPost extends Model
{
    protected $fillable = [
        'title',
        'summary',
        'body',
        'image',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];
}