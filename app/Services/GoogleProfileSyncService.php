<?php

namespace App\Services;

use App\Models\Profile;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleProfileSyncService
{
    /**
     * Sync a user's Google profile if the last sync
     * was more than 24 hours ago.
     */
    public function sync(SocialAccount $socialAccount): void
    {
        if ($socialAccount->provider !== 'google') {
            return;
        }

        /*
         * Do not contact Google more than once every 24 hours.
         */
        if (
            $socialAccount->profile_synced_at &&
            $socialAccount->profile_synced_at->gt(now()->subDay())
        ) {
            return;
        }

        /*
         * Make sure we have a refresh token.
         */
        if (!$socialAccount->refresh_token) {
            return;
        }

        try {

            /*
             * Get a fresh Google access token.
             */
            $accessToken = $this->refreshAccessToken(
                $socialAccount
            );

            if (!$accessToken) {
                return;
            }

            /*
             * Ask Google for the latest user profile.
             */
            $response = Http::withToken($accessToken)
                ->timeout(10)
                ->get(
                    'https://www.googleapis.com/oauth2/v2/userinfo'
                );

            if (!$response->successful()) {
                return;
            }

            $googleData = $response->json();

            $user = $socialAccount->user;

            if (!$user) {
                return;
            }

            /*
             * Update Google name.
             */
            if (!empty($googleData['name'])) {

                $user->update([
                    'name' => $googleData['name'],
                ]);

            }

            /*
             * Update Google profile picture.
             */
            if (!empty($googleData['picture'])) {

                $this->updateAvatar(
                    $user,
                    $googleData['picture']
                );

            }

            /*
             * Record successful synchronization.
             */
            $socialAccount->update([
                'profile_synced_at' => now(),
            ]);

        } catch (\Throwable $e) {

            /*
             * Never break DevNext because Google synchronization
             * failed.
             */
            report($e);
        }
    }


    /**
     * Refresh the Google access token.
     */
    private function refreshAccessToken(
        SocialAccount $socialAccount
    ): ?string {

        /*
         * If the current access token is still valid,
         * use it instead of refreshing unnecessarily.
         */
        if (
            $socialAccount->access_token &&
            $socialAccount->token_expires_at &&
            $socialAccount->token_expires_at->isFuture()
        ) {
            return $socialAccount->access_token;
        }

        /*
         * Ask Google for a new access token.
         */
        $response = Http::asForm()
            ->timeout(10)
            ->post(
                'https://oauth2.googleapis.com/token',
                [
                    'client_id' => config('services.google.client_id'),

                    'client_secret' => config('services.google.client_secret'),

                    'refresh_token' => $socialAccount->refresh_token,

                    'grant_type' => 'refresh_token',
                ]
            );

        if (!$response->successful()) {
            return null;
        }

        $data = $response->json();

        if (empty($data['access_token'])) {
            return null;
        }

        $expiresIn = $data['expires_in'] ?? null;

        $updateData = [
            'access_token' => $data['access_token'],
            'token_expires_at' => $expiresIn
                ? now()->addSeconds($expiresIn)
                : null,
        ];

        /*
         * Google normally keeps the same refresh token,
         * but if it provides a new one, save it.
         */
        if (!empty($data['refresh_token'])) {

            $updateData['refresh_token'] =
                $data['refresh_token'];

        }

        $socialAccount->update($updateData);

        return $data['access_token'];
    }


    /**
     * Download and replace the user's Google avatar.
     */
    private function updateAvatar(
        $user,
        string $googleAvatar
    ): void {

        $profile = $user->profile;

        if (!$profile) {
            return;
        }

        try {

            $response = Http::timeout(10)
                ->get($googleAvatar);

            if (!$response->successful()) {
                return;
            }

            $extension = $this->detectImageExtension(
                $response->header('Content-Type')
            );

            $filename =
                'google-' .
                $user->id .
                '-' .
                Str::random(20) .
                '.' .
                $extension;

            $path = 'avatars/' . $filename;

            /*
             * Delete the previous avatar.
             */
            if ($profile->avatar) {

                Storage::disk('public')
                    ->delete($profile->avatar);

            }

            /*
             * Store the new Google avatar.
             */
            Storage::disk('public')->put(
                $path,
                $response->body()
            );

            /*
             * Update profile record.
             */
            $profile->update([
                'avatar' => $path,
            ]);

        } catch (\Throwable $e) {

            report($e);
        }
    }


    /**
     * Detect image extension from content type.
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
}