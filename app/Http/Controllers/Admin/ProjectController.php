<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category' => 'nullable|string|max:255',
            'is_premium' => 'boolean',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'published_at' => 'nullable|date',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Project Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('projects', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Premium Checkbox
        |--------------------------------------------------------------------------
        */

        $validated['is_premium'] = $request->has('is_premium');

        Project::create($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug,' . $project->id,
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category' => 'nullable|string|max:255',
            'is_premium' => 'boolean',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'published_at' => 'nullable|date',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Premium Checkbox
        |--------------------------------------------------------------------------
        */

        $validated['is_premium'] = $request->has('is_premium');

        /*
        |--------------------------------------------------------------------------
        | Replace Project Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            // Delete old image
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }

            // Store new image
            $validated['image'] = $request
                ->file('image')
                ->store('projects', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Update Project
        |--------------------------------------------------------------------------
        */

        $project->update($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        /*
        |--------------------------------------------------------------------------
        | Delete Project Image
        |--------------------------------------------------------------------------
        */

        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Project
        |--------------------------------------------------------------------------
        */

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }
}