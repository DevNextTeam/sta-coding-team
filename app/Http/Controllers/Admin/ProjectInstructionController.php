<?php

namespace App\Http\Controllers\Admin;

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

    public function store(Request $request, Project $project)
    {
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
        | Upload Instruction Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store('project-instructions', 'public');
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
                ->store('project-instructions', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Update Instruction
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

    public function destroy(ProjectInstruction $instruction)
    {
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
}