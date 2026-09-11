<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\ProjectComment;

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
    | Project Owner
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

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

    /*
    |--------------------------------------------------------------------------
    | Project Likes
    |--------------------------------------------------------------------------
    */

    public function likedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_likes')
            ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Project Saves
    |--------------------------------------------------------------------------
    */

    public function savedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'project_saves')
            ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Project Comments
    |--------------------------------------------------------------------------
    */

    public function comments(): HasMany
    {
        return $this->hasMany(ProjectComment::class)
            ->latest();
    }
}
