<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display all published projects.
     */
    public function index(Request $request)
    {
        $search = trim($request->input('search', ''));

        $projects = Project::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->when($search !== '', function ($query) use ($search) {

                $query->where(function ($query) use ($search) {

                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('category', 'like', "%{$search}%");

                });

            })
            ->latest('published_at')
            ->get();

        return view('projects.index', compact(
            'projects',
            'search'
        ));
    }

    /**
     * Display a single project.
     */
    public function show(Project $project)
    {
        /*
        |--------------------------------------------------------------------------
        | Free Project
        |--------------------------------------------------------------------------
        |
        | Free projects can be viewed by everyone.
        |
        */

        if (!$project->is_premium) {

            $hasAccess = true;

            return view('projects.show', compact(
                'project',
                'hasAccess'
            ));
        }


        /*
        |--------------------------------------------------------------------------
        | Premium Project
        |--------------------------------------------------------------------------
        |
        | Premium projects require:
        | 1. User must be logged in
        | 2. User must have an active subscription
        |
        */

        $hasAccess = false;

        if (auth()->check()) {

            $subscription = auth()->user()->subscription;

            if ($subscription && $subscription->isActive()) {
                $hasAccess = true;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Display Project
        |--------------------------------------------------------------------------
        */

        return view('projects.show', compact(
            'project',
            'hasAccess'
        ));
    }
}