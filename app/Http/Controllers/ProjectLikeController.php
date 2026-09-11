<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectLikeController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $project->likedBy()->syncWithoutDetaching([
            $request->user()->id,
        ]);

        return response()->json([
            'liked' => true,
            'like_count' => $project->likedBy()->count(),
        ]);
    }

    public function destroy(Request $request, Project $project)
    {
        $project->likedBy()->detach(
            $request->user()->id
        );

        return response()->json([
            'liked' => false,
            'like_count' => $project->likedBy()->count(),
        ]);
    }
}