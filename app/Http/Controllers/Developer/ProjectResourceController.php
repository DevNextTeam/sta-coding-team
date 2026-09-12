<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectResourceController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Store Resource
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, Project $project)
    {
        $this->authorizeProject($request, $project);

        $validated = $request->validate([
            'file' => [
                'required',
                'file',
                'max:10240',
            ],
        ]);

        $file = $validated['file'];

        /*
        |--------------------------------------------------------------------------
        | Choose Storage Disk
        |--------------------------------------------------------------------------
        */

        $disk = $project->is_premium
            ? 'local'
            : 'public';

        $path = $file->store(
            'projects/resources',
            $disk
        );

        /*
        |--------------------------------------------------------------------------
        | Create Resource
        |--------------------------------------------------------------------------
        */

        $project->resources()->create([
            'name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return back()->with(
            'success',
            'Resource uploaded successfully!'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Resource
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Request $request,
        ProjectResource $resource
    ) {
        $project = $resource->project;

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        |
        | Admin and Developer accounts can delete resources
        | from ANY project.
        |
        | Regular users can only delete resources from
        | their own projects.
        |
        */

        abort_unless(
            $project &&
            (
                in_array($request->user()->role, ['admin', 'developer']) ||
                $project->user_id === $request->user()->id
            ),
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Delete Actual File
        |--------------------------------------------------------------------------
        */

        $disk = $project->is_premium
            ? 'local'
            : 'public';

        Storage::disk($disk)->delete(
            $resource->file_path
        );

        /*
        |--------------------------------------------------------------------------
        | Delete Resource Record
        |--------------------------------------------------------------------------
        */

        $resource->delete();

        return back()->with(
            'success',
            'Resource deleted successfully!'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Project Authorization
    |--------------------------------------------------------------------------
    |
    | Admin and Developer:
    | Can manage resources for ANY project.
    |
    | Regular User:
    | Can only manage resources for their OWN project.
    |
    */

    private function authorizeProject(
        Request $request,
        Project $project
    ): void {
        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Admin & Developer Have Full Access
        |--------------------------------------------------------------------------
        */

        if (in_array($user->role, ['admin', 'developer'])) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Regular User Can Only Manage Their Own Project
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $project->user_id === $user->id,
            403
        );
    }
}