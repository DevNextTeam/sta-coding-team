<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;

class GoogleAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Google Login
    |--------------------------------------------------------------------------
    */

    public function redirect()
    {
        return Socialite::driver('google')
        ->with([
            'access_type' => 'offline',
            'prompt' => 'consent',
        ])
        ->redirect();
    }


    /*
    |--------------------------------------------------------------------------
    | Google Login Callback
    |--------------------------------------------------------------------------
    */

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        /*
        |--------------------------------------------------------------------------
        | Get Google account information
        |--------------------------------------------------------------------------
        */

        $googleId = $googleUser->getId();
        $googleEmail = $googleUser->getEmail();
        $googleName = $googleUser->getName() ?: 'Google User';
        $googleAvatar = $googleUser->getAvatar();


        /*
        |--------------------------------------------------------------------------
        | Make sure Google provided an email
        |--------------------------------------------------------------------------
        */

        if (!$googleEmail) {

            return $this->googlePopupError(
                'Unable to retrieve your Google email address.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Make sure Google email is verified
        |--------------------------------------------------------------------------
        */

        $rawGoogleUser = $googleUser->getRaw();

        if (
            isset($rawGoogleUser['email_verified']) &&
            !$rawGoogleUser['email_verified']
        ) {

            return $this->googlePopupError(
                'Your Google email address must be verified.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Check if Google account is already connected
        |--------------------------------------------------------------------------
        */

        $socialAccount = SocialAccount::where('provider', 'google')
            ->where('provider_id', $googleId)
            ->first();


        if ($socialAccount) {

            $user = $socialAccount->user;

            /*
             * Save the latest Google OAuth tokens.
             */
            $this->saveGoogleTokens(
                $socialAccount,
                $googleUser
            );

            /*
             * Sync Google profile information.
             */
            $this->syncGoogleProfile(
                $user,
                $googleName,
                $googleAvatar
            );

            Auth::login($user);

            return $this->googlePopupSuccess();

        }


        /*
        |--------------------------------------------------------------------------
        | Find existing DevNext account by Google email
        |--------------------------------------------------------------------------
        */

        $user = User::where('email', $googleEmail)->first();


        /*
        |--------------------------------------------------------------------------
        | Create new DevNext account
        |--------------------------------------------------------------------------
        */

        if (!$user) {

            $username = Str::slug($googleName);

            if (!$username) {
                $username = 'developer';
            }

            $originalUsername = $username;
            $counter = 1;

            while (
                Profile::where('username', $username)->exists()
            ) {

                $username = $originalUsername . '-' . $counter;

                $counter++;

            }


            $user = User::create([
            'name' => $googleName,
            'email' => $googleEmail,
            'password' => Hash::make(Str::random(64)),
            'role' => 'user',
        ]);


            /*
            |--------------------------------------------------------------------------
            | Create profile if UserObserver did not already create one
            |--------------------------------------------------------------------------
            */

            if (!$user->profile()->exists()) {

                $user->profile()->create([
                    'username' => $username,
                    'headline' => 'Developer',
                ]);

            }

        }


        /*
        |--------------------------------------------------------------------------
        | Connect Google account
        |--------------------------------------------------------------------------
        */

        $existingGoogleConnection = SocialAccount::where('user_id', $user->id)
            ->where('provider', 'google')
            ->first();


        if ($existingGoogleConnection) {

            $socialAccount = $existingGoogleConnection;

        } else {

            $socialAccount = SocialAccount::create([
                'user_id' => $user->id,
                'provider' => 'google',
                'provider_id' => $googleId,
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Save Google OAuth tokens
        |--------------------------------------------------------------------------
        */

        $this->saveGoogleTokens(
            $socialAccount,
            $googleUser
        );


        /*
        |--------------------------------------------------------------------------
        | Sync Google profile information
        |--------------------------------------------------------------------------
        */

        $this->syncGoogleProfile(
            $user,
            $googleName,
            $googleAvatar
        );


        /*
        |--------------------------------------------------------------------------
        | Log user in
        |--------------------------------------------------------------------------
        */

        Auth::login($user);

        return $this->googlePopupSuccess();
    }


    /*
    |--------------------------------------------------------------------------
    | Connect Google
    |--------------------------------------------------------------------------
    |
    | This is different from Google Login.
    |
    | The user must already be logged into DevNext.
    | Google is connected to the currently authenticated account.
    |
    */

    public function connectRedirect()
    {
        
        if (!Auth::check()) {

            return redirect()
                ->route('login')
                ->with(
                    'error',
                    'Please log in before connecting Google.'
                );

        }


        return Socialite::driver('google')
        ->with([
            'access_type' => 'offline',
            'prompt' => 'consent',
        ])
        ->redirect();
    }


    /*
    |--------------------------------------------------------------------------
    | Connect Google Callback
    |--------------------------------------------------------------------------
    */

    public function connectCallback()
    {
        if (!Auth::check()) {

            return $this->googlePopupError(
                'Your DevNext session has expired. Please log in again.'
            );

        }


        $googleUser = Socialite::driver('google')->user();


        /*
        |--------------------------------------------------------------------------
        | Get Google account information
        |--------------------------------------------------------------------------
        */

        $googleId = $googleUser->getId();
        $googleEmail = $googleUser->getEmail();
        $googleName = $googleUser->getName() ?: 'Google User';
        $googleAvatar = $googleUser->getAvatar();


        /*
        |--------------------------------------------------------------------------
        | Make sure Google provided an email
        |--------------------------------------------------------------------------
        */

        if (!$googleEmail) {

            return $this->googlePopupError(
                'Unable to retrieve your Google email address.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Make sure Google email is verified
        |--------------------------------------------------------------------------
        */

        $rawGoogleUser = $googleUser->getRaw();

        if (
            isset($rawGoogleUser['email_verified']) &&
            !$rawGoogleUser['email_verified']
        ) {

            return $this->googlePopupError(
                'Your Google email address must be verified.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Current DevNext user
        |--------------------------------------------------------------------------
        */

        $currentUser = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | Check whether this Google account is already connected
        |--------------------------------------------------------------------------
        */

        $existingConnection = SocialAccount::where('provider', 'google')
            ->where('provider_id', $googleId)
            ->first();


        if ($existingConnection) {

            /*
             * Google is already connected to this same DevNext account.
             */

            if ($existingConnection->user_id === $currentUser->id) {

                /*
                 * Save latest Google OAuth tokens.
                 */
                $this->saveGoogleTokens(
                    $existingConnection,
                    $googleUser
                );

                /*
                 * Sync Google profile picture.
                 */
                $this->syncGoogleProfile(
                    $currentUser,
                    $googleName,
                    $googleAvatar
                );

                return $this->googlePopupSuccess();

            }


            /*
             * Google belongs to another DevNext account.
             */

            return $this->googlePopupError(
                'This Google account is already connected to another DevNext account.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Make sure current DevNext user does not already have Google
        |--------------------------------------------------------------------------
        */

        $currentGoogleConnection = SocialAccount::where('user_id', $currentUser->id)
            ->where('provider', 'google')
            ->first();


        if ($currentGoogleConnection) {

            return $this->googlePopupError(
                'A Google account is already connected to your DevNext account.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Prevent connecting a Google email belonging to another DevNext user
        |--------------------------------------------------------------------------
        */

        $emailUser = User::where('email', $googleEmail)
            ->where('id', '!=', $currentUser->id)
            ->first();


        if ($emailUser) {

            return $this->googlePopupError(
                'This Google email is already registered to another DevNext account.'
            );

        }


        /*
        |--------------------------------------------------------------------------
        | Create Google connection
        |--------------------------------------------------------------------------
        */

        $socialAccount = SocialAccount::create([
            'user_id' => $currentUser->id,
            'provider' => 'google',
            'provider_id' => $googleId,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Save Google OAuth tokens
        |--------------------------------------------------------------------------
        */

        $this->saveGoogleTokens(
            $socialAccount,
            $googleUser
        );


        /*
        |--------------------------------------------------------------------------
        | Sync Google profile information
        |--------------------------------------------------------------------------
        */

        $this->syncGoogleProfile(
            $currentUser,
            $googleName,
            $googleAvatar
        );


        /*
        |--------------------------------------------------------------------------
        | Successfully connected
        |--------------------------------------------------------------------------
        */

        return $this->googlePopupSuccess();

    }


    /*
    |--------------------------------------------------------------------------
    | Save Google OAuth Tokens
    |--------------------------------------------------------------------------
    */

    private function saveGoogleTokens(
        SocialAccount $socialAccount,
        $googleUser
    ): void {

        /*
         * Socialite provides the OAuth access token.
         */
        $accessToken = $googleUser->token;

        /*
         * The refresh token may only be returned by Google
         * during certain authorization flows.
         *
         * Therefore, we DO NOT overwrite an existing refresh
         * token with null.
         */
        $refreshToken = $googleUser->refreshToken;

        /*
         * Number of seconds until the access token expires.
         */
        $expiresIn = $googleUser->expiresIn;


        $data = [
            'access_token' => $accessToken,
            'token_expires_at' => $expiresIn
                ? now()->addSeconds($expiresIn)
                : null,
            'profile_synced_at' => now(),
        ];


        /*
         * Only replace the refresh token if Google
         * actually gave us a new one.
         */
        if ($refreshToken) {

            $data['refresh_token'] = $refreshToken;

        }


        $socialAccount->update($data);

    }


    /*
    |--------------------------------------------------------------------------
    | Sync Google Profile
    |--------------------------------------------------------------------------
    |
    | Updates:
    |
    | - DevNext user's name
    | - DevNext profile avatar
    |
    | It does NOT overwrite:
    |
    | - Username
    | - Headline
    | - Bio
    | - Skills
    | - GitHub
    | - Website
    |
    */

    private function syncGoogleProfile(
        User $user,
        ?string $googleName,
        ?string $googleAvatar
    ): void {

        /*
        |--------------------------------------------------------------------------
        | Make sure profile exists
        |--------------------------------------------------------------------------
        */

        $profile = $user->profile;


        if (!$profile) {

            $username = Str::slug(
                $googleName ?: $user->name
            );

            if (!$username) {
                $username = 'developer';
            }


            $originalUsername = $username;
            $counter = 1;


            while (
                Profile::where('username', $username)
                    ->where('user_id', '!=', $user->id)
                    ->exists()
            ) {

                $username = $originalUsername . '-' . $counter;

                $counter++;

            }


            $profile = $user->profile()->create([
                'username' => $username,
                'headline' => 'Developer',
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Update DevNext user's name
        |--------------------------------------------------------------------------
        */

        if ($googleName) {

            $user->update([
                'name' => $googleName,
            ]);

        }


        /*
        |--------------------------------------------------------------------------
        | Download Google profile picture
        |--------------------------------------------------------------------------
        */

        if ($googleAvatar) {

            try {

                $response = Http::timeout(10)
                    ->get($googleAvatar);


                /*
                |--------------------------------------------------------------------------
                | Make sure Google returned the image successfully
                |--------------------------------------------------------------------------
                */

                if ($response->successful()) {

                    $extension = $this->detectImageExtension(
                        $response->header('Content-Type')
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Generate unique filename
                    |--------------------------------------------------------------------------
                    */

                    $filename =
                        'google-' .
                        $user->id .
                        '-' .
                        Str::random(20) .
                        '.' .
                        $extension;


                    $path = 'avatars/' . $filename;


                    /*
                    |--------------------------------------------------------------------------
                    | Delete previous locally stored avatar
                    |--------------------------------------------------------------------------
                    */

                    if ($profile->avatar) {

                        Storage::disk('public')
                            ->delete($profile->avatar);

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Store new Google avatar
                    |--------------------------------------------------------------------------
                    */

                    Storage::disk('public')->put(
                        $path,
                        $response->body()
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | Update profile avatar
                    |--------------------------------------------------------------------------
                    */

                    $profile->update([
                        'avatar' => $path,
                    ]);

                }

            } catch (\Throwable $e) {

                /*
                |--------------------------------------------------------------------------
                | Do not prevent Google login if avatar download fails.
                |--------------------------------------------------------------------------
                */

                report($e);

            }

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Detect Image Extension
    |--------------------------------------------------------------------------
    */

    private function detectImageExtension(
        ?string $contentType
    ): string {

        return match (strtolower((string) $contentType)) {

            'image/jpeg',
            'image/jpg' => 'jpg',

            'image/png' => 'png',

            'image/webp' => 'webp',

            'image/gif' => 'gif',

            default => 'jpg',

        };

    }


    /*
    |--------------------------------------------------------------------------
    | Google Popup Success Response
    |--------------------------------------------------------------------------
    */

    private function googlePopupSuccess()
    {
        return response()->view(
            'auth.google-success'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Google Popup Error Response
    |--------------------------------------------------------------------------
    */

    private function googlePopupError(
        string $message
    ) {

        return response()->view(
            'auth.google-error',
            [
                'message' => $message,
            ]
        );

    }
}