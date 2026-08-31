<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectResourceController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:10240',
        ]);

        $file = $validated['file'];

        // Premium resources are stored privately.
        // Free resources are stored publicly.
        $disk = $project->is_premium ? 'local' : 'public';

        $path = $file->store('projects/resources', $disk);

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

    public function destroy(ProjectResource $resource)
    {
        $project = $resource->project;

        // Delete the actual file from the correct disk.
        $disk = $project->is_premium ? 'local' : 'public';

        Storage::disk($disk)->delete($resource->file_path);

        $resource->delete();

        return back()->with(
            'success',
            'Resource deleted successfully!'
        );
    }
}