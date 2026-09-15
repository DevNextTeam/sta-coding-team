<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SuspendUser extends Command
{
    protected $signature = 'user:suspend {email} {days=7}';

    protected $description = 'Suspend a user for a specific number of days';

    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (!$user) {
            $this->error('User not found.');
            return self::FAILURE;
        }

        if (in_array($user->role, ['admin', 'developer'])) {
            $this->error('Admin and developer accounts cannot be suspended.');
            return self::FAILURE;
        }

        $days = max(1, (int) $this->argument('days'));

        $user->update([
            'status' => 'suspended',
            'status_until' => now()->addDays($days),
        ]);

        $this->info("{$user->name} has been suspended for {$days} days.");

        return self::SUCCESS;
    }
}