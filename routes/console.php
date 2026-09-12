<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display the inspiring quote');


/*
|--------------------------------------------------------------------------
| Expire subscriptions
|--------------------------------------------------------------------------
*/

Schedule::command('app:expire-subscriptions')
    ->daily();


/*
|--------------------------------------------------------------------------
| Sync Google profiles
|--------------------------------------------------------------------------
|
| Check Google-connected accounts every hour.
| The queued job performs the actual synchronization.
|
*/

Schedule::call(function () {

    \App\Models\SocialAccount::where('provider', 'google')
        ->whereNotNull('refresh_token')
        ->pluck('id')
        ->each(function ($socialAccountId) {

            \App\Jobs\SyncGoogleProfile::dispatch(
                $socialAccountId
            );

        });

})->hourly();