<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavedProjectController extends Controller
{
    /**
     * Display the projects saved by the authenticated user.
     */
    public function index(Request $request)
    {
        $projects = $request->user()
            ->savedProjects()
            ->with('user.profile')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('project_saves.created_at')
            ->get();

        return view(
            'saved-projects.index',
            compact('projects')
        );
    }
}