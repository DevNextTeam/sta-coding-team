<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'category',
        'is_premium',
        'github_url',
        'demo_url',
        'video_url',
        'published_at',
    ];

    protected $casts = [
        'is_premium' => 'boolean',
        'published_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Project Resources
    |--------------------------------------------------------------------------
    */

    public function resources(): HasMany
    {
        return $this->hasMany(ProjectResource::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Project Instructions
    |--------------------------------------------------------------------------
    */

    public function instructions(): HasMany
    {
        return $this->hasMany(ProjectInstruction::class)
            ->orderBy('step');
    }
}