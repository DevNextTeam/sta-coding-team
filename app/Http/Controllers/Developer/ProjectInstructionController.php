<?php

namespace App\Http\Controllers\Developer;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectInstruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectInstructionController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Store Instruction
    |--------------------------------------------------------------------------
    */

    public function store(
        Request $request,
        Project $project
    ) {
        $this->authorizeProject($request, $project);

        $validated = $request->validate([
            'step' => [
                'required',
                'integer',
                'min:1',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store(
                    'project-instructions',
                    'public'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Create Instruction
        |--------------------------------------------------------------------------
        */

        $project->instructions()->create($validated);

        return back()->with(
            'success',
            'Project instruction added successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Instruction
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        ProjectInstruction $instruction
    ) {
        $this->authorizeInstruction(
            $request,
            $instruction
        );

        $validated = $request->validate([
            'step' => [
                'required',
                'integer',
                'min:1',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Replace Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if (
                $instruction->image &&
                Storage::disk('public')->exists(
                    $instruction->image
                )
            ) {
                Storage::disk('public')->delete(
                    $instruction->image
                );
            }

            $validated['image'] = $request
                ->file('image')
                ->store(
                    'project-instructions',
                    'public'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $instruction->update($validated);

        return back()->with(
            'success',
            'Project instruction updated successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Instruction
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Request $request,
        ProjectInstruction $instruction
    ) {
        $this->authorizeInstruction(
            $request,
            $instruction
        );

        /*
        |--------------------------------------------------------------------------
        | Delete Image
        |--------------------------------------------------------------------------
        */

        if (
            $instruction->image &&
            Storage::disk('public')->exists(
                $instruction->image
            )
        ) {
            Storage::disk('public')->delete(
                $instruction->image
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Delete Instruction
        |--------------------------------------------------------------------------
        */

        $instruction->delete();

        return back()->with(
            'success',
            'Project instruction deleted successfully.'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Project Authorization
    |--------------------------------------------------------------------------
    |
    | Admin and Developer:
    | Can manage instructions for ANY project.
    |
    | Regular User:
    | Can only manage instructions for their OWN project.
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


    /*
    |--------------------------------------------------------------------------
    | Instruction Authorization
    |--------------------------------------------------------------------------
    |
    | Admin and Developer:
    | Can manage instructions for ANY project.
    |
    | Regular User:
    | Can only manage instructions belonging to their
    | own project.
    |
    */

    private function authorizeInstruction(
        Request $request,
        ProjectInstruction $instruction
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
            $instruction->project &&
            $instruction->project->user_id === $user->id,
            403
        );
    }
}