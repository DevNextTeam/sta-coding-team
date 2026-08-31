<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
}