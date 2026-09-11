<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Verify the user's current password.
     */
    public function verifyPassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
        ]);

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->withErrors([
                    'current_password' => 'The current password is incorrect.',
                ], 'passwordVerification')
                ->withInput();
        }

        // Store temporary password verification in the session.
        $request->session()->put('password_verified', true);

        return back()->with('password_verified', true);
    }

    /**
     * Show the profile edit page.
     */
    public function edit(Request $request)
    {
        $profile = $request->user()->profile;

        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the authenticated user's developer profile.
     */
    public function update(Request $request)
    {
        $user = $request->user();
        $profile = $user->profile;

        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'min:3',
                'max:30',
                'alpha_dash',
                Rule::unique('profiles', 'username')->ignore($profile->id),
            ],

            'headline' => [
                'nullable',
                'string',
                'max:100',
            ],

            'bio' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'avatar' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'github_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'website_url' => [
                'nullable',
                'url',
                'max:255',
            ],

            'skills' => [
                'nullable',
                'string',
                'max:500',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Username
        |--------------------------------------------------------------------------
        */

        $profile->username = $validated['username'];

        /*
        |--------------------------------------------------------------------------
        | Basic Profile Information
        |--------------------------------------------------------------------------
        */

        $profile->headline = $validated['headline'] ?? null;
        $profile->bio = $validated['bio'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | Social Links
        |--------------------------------------------------------------------------
        */

        $profile->github_url = $validated['github_url'] ?? null;
        $profile->website_url = $validated['website_url'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | Skills
        |--------------------------------------------------------------------------
        |
        | Example input:
        |
        | HTML, CSS, JavaScript, PHP, Laravel
        |
        | This gets converted into:
        |
        | [
        |     "HTML",
        |     "CSS",
        |     "JavaScript",
        |     "PHP",
        |     "Laravel"
        | ]
        |
        */

        if (!empty($validated['skills'])) {
            $skills = collect(explode(',', $validated['skills']))
                ->map(fn ($skill) => trim($skill))
                ->filter()
                ->unique()
                ->values()
                ->all();

            $profile->skills = $skills;
        } else {
            $profile->skills = [];
        }

        /*
        |--------------------------------------------------------------------------
        | Avatar Upload
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('avatar')) {

            // Delete old avatar if one exists.
            if ($profile->avatar) {
                Storage::disk('public')->delete($profile->avatar);
            }

            // Store new avatar.
            $profile->avatar = $request
                ->file('avatar')
                ->store('avatars', 'public');
        }

        $profile->save();

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Your developer profile has been updated successfully.');
    }

    /**
     * Show a public developer profile.
     */
    public function show(string $username)
    {
        $profile = Profile::with([
            'user.projects' => function ($query) {
                $query->whereNotNull('published_at')
                    ->where('published_at', '<=', now())
                    ->latest('published_at');
            }
        ])
            ->where('username', $username)
            ->firstOrFail();

        return view('profile.show', compact('profile'));
    }
}