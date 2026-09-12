<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PasswordResetCodeController extends Controller
{
    /**
     * Show the verification-code page.
     */
    public function show(Request $request)
    {
        return view('auth.verify-reset-code', [
            'email' => $request->query('email'),
        ]);
    }

    /**
     * Verify the 6-digit password reset code.
     */
    public function verify(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'code' => [
                'required',
                'digits:6',
            ],
        ]);

        /*
         * Find the latest unused code for this email.
         */
        $resetCode = PasswordResetCode::where(
            'email',
            $validated['email']
        )
            ->whereNull('used_at')
            ->latest()
            ->first();

        /*
         * Make sure the code exists and has not expired.
         */
        if (!$resetCode || !$resetCode->isValid()) {
            throw ValidationException::withMessages([
                'code' => 'This verification code is invalid or has expired.',
            ]);
        }

        /*
         * Compare the entered code with the hashed code.
         */
        if (!Hash::check($validated['code'], $resetCode->code)) {
            throw ValidationException::withMessages([
                'code' => 'The verification code is incorrect.',
            ]);
        }

        /*
         * Store the verified code in the session.
         *
         * The browser does not get to choose which
         * database record is considered verified.
         */
        $request->session()->put(
            'password_reset_code_id',
            $resetCode->id
        );

        $request->session()->put(
            'password_reset_email',
            $resetCode->email
        );

        return redirect()
            ->route('password.reset.code.form');
    }

    /**
     * Show the new-password form after
     * successful code verification.
     */
    public function passwordForm(Request $request)
    {
        if (
            !$request->session()->has('password_reset_code_id') ||
            !$request->session()->has('password_reset_email')
        ) {
            return redirect()
                ->route('password.reset.code')
                ->with(
                    'error',
                    'Please verify your password reset code first.'
                );
        }

        return view('auth.reset-password-with-code', [
            'email' => $request->session()->get(
                'password_reset_email'
            ),
        ]);
    }

    /**
     * Reset the user's password after
     * successful code verification.
     */
    public function resetPassword(Request $request)
    {
        $codeId = $request->session()->get(
            'password_reset_code_id'
        );

        $email = $request->session()->get(
            'password_reset_email'
        );

        /*
         * Make sure the verification session exists.
         */
        if (!$codeId || !$email) {
            return redirect()
                ->route('password.reset.code')
                ->with(
                    'error',
                    'Your password reset session has expired.'
                );
        }

        /*
         * Retrieve the exact verified code.
         */
        $resetCode = PasswordResetCode::where('id', $codeId)
            ->where('email', $email)
            ->whereNull('used_at')
            ->first();

        /*
         * Make sure the code is still valid.
         */
        if (!$resetCode || !$resetCode->isValid()) {
            $request->session()->forget([
                'password_reset_code_id',
                'password_reset_email',
            ]);

            return redirect()
                ->route('password.reset.code')
                ->with(
                    'error',
                    'Your verification code has expired.'
                );
        }

        /*
         * Use the same password rules used by
         * your Fortify PasswordValidationRules trait.
         */
        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'confirmed',
                'min:8',
            ],
        ]);

        /*
         * Find the account belonging to the
         * verified email address.
         */
        $user = User::where('email', $email)->first();

        if (!$user) {
            $request->session()->forget([
                'password_reset_code_id',
                'password_reset_email',
            ]);

            return redirect()
                ->route('password.reset.code')
                ->with(
                    'error',
                    'We could not find an account with that email address.'
                );
        }

        /*
         * Update the password.
         *
         * Your User model has the "hashed" cast,
         * but we explicitly hash here as well.
         */
        $user->forceFill([
            'password' => Hash::make(
                $validated['password']
            ),
        ])->save();

        /*
         * Mark the verification code as used.
         *
         * This prevents the same code from
         * resetting the password again.
         */
        $resetCode->update([
            'used_at' => now(),
        ]);

        /*
         * Clear the password-reset session.
         */
        $request->session()->forget([
            'password_reset_code_id',
            'password_reset_email',
        ]);

        return redirect()
            ->route('login')
            ->with(
                'status',
                'Your password has been reset successfully. You can now log in with your new password.'
            );
    }
}
