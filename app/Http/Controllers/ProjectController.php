<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display all published projects.
     */
    public function index()
    {
        $projects = Project::whereNotNull('published_at')
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
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