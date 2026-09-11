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

        abort_unless(
            $project &&
            $project->user_id === $request->user()->id,
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

        $resource->delete();

        return back()->with(
            'success',
            'Resource deleted successfully!'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Project Ownership
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