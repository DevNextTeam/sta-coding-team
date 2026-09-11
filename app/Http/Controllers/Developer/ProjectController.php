<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DISPLAY DEVELOPER PROJECTS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $projects = $request->user()
            ->projects()
            ->with('user.profile')
            ->latest()
            ->get();

        return view(
            'developer.projects.index',
            compact('projects')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE PROJECT PAGE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('developer.projects.create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE PROJECT
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'max:5120'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'video_url' => ['nullable', 'url', 'max:255'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Generate Unique Slug
        |--------------------------------------------------------------------------
        */

        $slug = Str::slug($validated['title']);

        $originalSlug = $slug;
        $counter = 2;

        while (Project::where('slug', $slug)->exists()) {

            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }


        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store('projects', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Create Project
        |--------------------------------------------------------------------------
        |
        | Using the authenticated user's projects()
        | relationship automatically assigns user_id.
        |
        */

        $request->user()->projects()->create([

            'title' => $validated['title'],

            'slug' => $slug,

            'description' => $validated['description'],

            'category' => $validated['category'] ?? null,

            'image' => $imagePath,

            'is_premium' => false,

            'github_url' => $validated['github_url'] ?? null,

            'demo_url' => $validated['demo_url'] ?? null,

            'video_url' => $validated['video_url'] ?? null,

            'published_at' => $request->boolean('published')
                ? now()
                : null,

        ]);


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('developer.projects.index')
            ->with(
                'success',
                'Project created successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT PROJECT
    |--------------------------------------------------------------------------
    */

    public function edit(
        Request $request,
        Project $project
    ) {

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        $this->authorizeProject(
            $request,
            $project
        );


        /*
        |--------------------------------------------------------------------------
        | Load Resources + Instructions
        |--------------------------------------------------------------------------
        |
        | These relationships are used by the Developer Edit Project page.
        |
        */

        $project->load([

            'resources',

            'instructions' => function ($query) {

                $query->orderBy('step');

            },

        ]);


        /*
        |--------------------------------------------------------------------------
        | Return Edit View
        |--------------------------------------------------------------------------
        */

        return view(
            'developer.projects.edit',
            compact('project')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROJECT
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Project $project
    ) {

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        $this->authorizeProject(
            $request,
            $project
        );


        /*
        |--------------------------------------------------------------------------
        | Validate
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'max:5120'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'video_url' => ['nullable', 'url', 'max:255'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Basic Information
        |--------------------------------------------------------------------------
        */

        $project->title = $validated['title'];

        $project->description = $validated['description'];

        $project->category = $validated['category'] ?? null;

        $project->github_url = $validated['github_url'] ?? null;

        $project->demo_url = $validated['demo_url'] ?? null;

        $project->video_url = $validated['video_url'] ?? null;


        /*
        |--------------------------------------------------------------------------
        | Published Status
        |--------------------------------------------------------------------------
        */

        if ($request->boolean('published')) {

            if (!$project->published_at) {

                $project->published_at = now();

            }

        } else {

            $project->published_at = null;

        }


        /*
        |--------------------------------------------------------------------------
        | Replace Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if ($project->image) {

                Storage::disk('public')
                    ->delete($project->image);
            }


            $project->image = $request
                ->file('image')
                ->store('projects', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Save
        |--------------------------------------------------------------------------
        */

        $project->save();


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('developer.projects.index')
            ->with(
                'success',
                'Project updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE PROJECT
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Request $request,
        Project $project
    ) {

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        $this->authorizeProject(
            $request,
            $project
        );


        /*
        |--------------------------------------------------------------------------
        | Delete Project Image
        |--------------------------------------------------------------------------
        */

        if ($project->image) {

            Storage::disk('public')
                ->delete($project->image);
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Related Records
        |--------------------------------------------------------------------------
        */

        $project->resources()->delete();

        $project->instructions()->delete();


        /*
        |--------------------------------------------------------------------------
        | Delete Project
        |--------------------------------------------------------------------------
        */

        $project->delete();


        /*
        |--------------------------------------------------------------------------
        | AJAX / FETCH RESPONSE
        |--------------------------------------------------------------------------
        |
        | Our modern frontend can use fetch() to delete projects.
        |
        */

        if ($request->expectsJson()) {

            return response()->json([
                'success' => true,
                'message' => 'Project deleted successfully.',
            ], 200);
        }


        /*
        |--------------------------------------------------------------------------
        | Normal Browser Request
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('developer.projects.index')
            ->with(
                'success',
                'Project deleted successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | AUTHORIZE PROJECT OWNER
    |--------------------------------------------------------------------------
    */

    private function authorizeProject(
        Request $request,
        Project $project
    ): void {

        abort_unless(
            $project->user_id === $request->user()->id,
            403
        );
    }
}