<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
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

        return view('projects.index', compact('projects', 'search'));
    }

    public function show(Project $project)
    {
        $project->load('user.profile');

        /*
        |--------------------------------------------------------------------------
        | Free Projects
        |--------------------------------------------------------------------------
        */

        if (!$project->is_premium) {

            $hasAccess = true;

            return view(
                'projects.show',
                compact('project', 'hasAccess')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Premium Projects
        |--------------------------------------------------------------------------
        */

        $hasAccess = auth()->check()
            && auth()->user()->hasPremiumAccess();

        return view(
            'projects.show',
            compact('project', 'hasAccess')
        );
    }
}