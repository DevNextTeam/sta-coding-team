<?php

namespace App\Jobs;

use App\Models\SocialAccount;
use App\Services\GoogleProfileSyncService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncGoogleProfile implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public int $socialAccountId
    ) {
    }

    public function handle(
        GoogleProfileSyncService $syncService
    ): void {

        $socialAccount = SocialAccount::find(
            $this->socialAccountId
        );

        if (!$socialAccount) {
            return;
        }

        $syncService->sync($socialAccount);
    }
}