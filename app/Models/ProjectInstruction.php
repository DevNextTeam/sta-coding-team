<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectInstruction extends Model
{
    protected $fillable = [
        'project_id',
        'step',
        'title',
        'description',
        'image',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}