<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display Projects
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $projects = Project::latest()->get();

        return view('admin.projects.index', compact('projects'));
    }

    /*
    |--------------------------------------------------------------------------
    | Create Project
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.projects.create');
    }

    /*
    |--------------------------------------------------------------------------
    | Store Project
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:projects,slug',
            ],

            'description' => [
                'required',
                'string',
            ],

            'category' => [
                'nullable',
                'string',
                'max:255',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'is_premium' => [
                'nullable',
                'boolean',
            ],

            'github_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'demo_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'video_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Image Upload
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

        $validated['is_premium'] = $request->boolean('is_premium');

        /*
        |--------------------------------------------------------------------------
        | Create Project
        |--------------------------------------------------------------------------
        */

        Project::create($validated);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Edit Project
    |--------------------------------------------------------------------------
    */

    public function edit(Project $project)
    {
        $project->load([
            'resources',
            'instructions',
        ]);

        return view(
            'admin.projects.edit',
            compact('project')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update Project
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:projects,slug,' . $project->id,
            ],

            'description' => [
                'required',
                'string',
            ],

            'category' => [
                'nullable',
                'string',
                'max:255',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'is_premium' => [
                'nullable',
                'boolean',
            ],

            'github_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'demo_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'video_url' => [
                'nullable',
                'url',
                'max:2048',
            ],

            'published_at' => [
                'nullable',
                'date',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Image Replacement
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('projects', 'public');
        } else {

            unset($validated['image']);
        }

        /*
        |--------------------------------------------------------------------------
        | Premium Checkbox
        |--------------------------------------------------------------------------
        */

        $validated['is_premium'] = $request->boolean('is_premium');

        /*
        |--------------------------------------------------------------------------
        | Update Project
        |--------------------------------------------------------------------------
        */

        $project->update($validated);

        return redirect()
            ->route('admin.projects.edit', $project)
            ->with('success', 'Project updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Project
    |--------------------------------------------------------------------------
    */

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
        | Delete Project Resources
        |--------------------------------------------------------------------------
        */

        foreach ($project->resources as $resource) {

            if ($resource->path) {
                Storage::disk('public')->delete($resource->path);
            }

            $resource->delete();
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Project Instructions
        |--------------------------------------------------------------------------
        */

        foreach ($project->instructions as $instruction) {

            if ($instruction->image) {
                Storage::disk('public')->delete(
                    $instruction->image
                );
            }

            $instruction->delete();
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Project
        |--------------------------------------------------------------------------
        */

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}