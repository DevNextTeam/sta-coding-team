<?php

namespace App\Http\Controllers;

use App\Models\ProjectResource;
use Illuminate\Support\Facades\Storage;

class ProjectResourceController extends Controller
{
    public function download(ProjectResource $resource)
    {
        $project = $resource->project;

        // Free projects are publicly downloadable.
        if (!$project->is_premium) {
            return Storage::disk('public')->download(
                $resource->file_path,
                $resource->name
            );
        }

        // Premium projects require an active subscription.
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $subscription = $user->subscription;

        if (!$subscription || !$subscription->isActive()) {
            return redirect()
                ->route('dashboard')
                ->with(
                    'error',
                    'You need an active subscription to download this resource.'
                );
        }

        // Premium files are stored on the private local disk.
        return Storage::disk('local')->download(
            $resource->file_path,
            $resource->name
        );
    }
}