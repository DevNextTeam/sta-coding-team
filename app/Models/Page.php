<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'content',
        'image',
        'builder_enabled',
    ];

    protected $casts = [
        'content' => 'array',
        'builder_enabled' => 'boolean',
    ];
}