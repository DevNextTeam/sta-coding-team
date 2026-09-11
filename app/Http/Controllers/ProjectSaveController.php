<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectSaveController extends Controller
{
    /**
     * Save a project.
     */
    public function store(Request $request, Project $project)
    {
        $project->savedBy()->syncWithoutDetaching([
            $request->user()->id,
        ]);

        return response()->json([
            'saved' => true,
            'save_count' => $project->savedBy()->count(),
        ]);
    }

    /**
     * Remove a project from saved projects.
     */
    public function destroy(Request $request, Project $project)
    {
        $project->savedBy()->detach(
            $request->user()->id
        );

        return response()->json([
            'saved' => false,
            'save_count' => $project->savedBy()->count(),
        ]);
    }
}