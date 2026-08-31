<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;

#[\Illuminate\Console\Attributes\Signature('app:expire-subscriptions')]
#[\Illuminate\Console\Attributes\Description('Expire subscriptions that have passed their end date')]
class ExpireSubscriptions extends Command
{
    public function handle()
    {
        $count = Subscription::where('status', 'active')
            ->whereNotNull('ends_at')
            ->where('ends_at', '<=', now())
            ->update([
                'status' => 'expired',
            ]);

        $this->info("Expired {$count} subscription(s).");

        return Command::SUCCESS;
    }
}