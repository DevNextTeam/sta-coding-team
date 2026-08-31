<?php

namespace App\Http\Controllers;

use App\Models\ProjectResource;
use Illuminate\Support\Facades\Storage;

class ProjectResourceController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | View Source Code
    |--------------------------------------------------------------------------
    */

    public function view(ProjectResource $resource)
    {
        $project = $resource->project;

        /*
        |--------------------------------------------------------------------------
        | Check Premium Access
        |--------------------------------------------------------------------------
        */

        if ($project->is_premium) {

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
                        'You need an active subscription to view this source code.'
                    );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Allowed Source Code Files
        |--------------------------------------------------------------------------
        */

        $allowedExtensions = [
            'php',
            'blade.php',
            'css',
            'js',
            'jsx',
            'ts',
            'tsx',
            'html',
            'htm',
            'json',
            'xml',
            'sql',
            'md',
            'txt',
            'vue',
            'env.example',
            'gitignore',
        ];

        $fileName = strtolower($resource->name);

        $isAllowed = false;

        foreach ($allowedExtensions as $extension) {

            if (
                str_ends_with($fileName, '.' . $extension) ||
                $fileName === $extension
            ) {
                $isAllowed = true;
                break;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent Unsupported Files
        |--------------------------------------------------------------------------
        */

        if (!$isAllowed) {
            return back()->with(
                'error',
                'This file cannot be displayed as source code.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Determine Storage Disk
        |--------------------------------------------------------------------------
        */

        $disk = $project->is_premium
            ? 'local'
            : 'public';

        /*
        |--------------------------------------------------------------------------
        | Make Sure File Exists
        |--------------------------------------------------------------------------
        */

        if (!Storage::disk($disk)->exists($resource->file_path)) {
            return back()->with(
                'error',
                'The source code file could not be found.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Read File
        |--------------------------------------------------------------------------
        */

        $content = Storage::disk($disk)->get(
            $resource->file_path
        );

        /*
        |--------------------------------------------------------------------------
        | Display Source Code
        |--------------------------------------------------------------------------
        */

        return view(
            'projects.source-code',
            compact(
                'project',
                'resource',
                'content'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Download Resource
    |--------------------------------------------------------------------------
    */

    public function download(ProjectResource $resource)
    {
        $project = $resource->project;

        /*
        |--------------------------------------------------------------------------
        | Free Projects
        |--------------------------------------------------------------------------
        */

        if (!$project->is_premium) {

            return Storage::disk('public')->download(
                $resource->file_path,
                $resource->name
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Premium Projects
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | Download Premium File
        |--------------------------------------------------------------------------
        */

        return Storage::disk('local')->download(
            $resource->file_path,
            $resource->name
        );
    }
}