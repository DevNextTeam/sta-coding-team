<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class BanUser extends Command
{
    protected $signature = 'user:ban {email} {days?}';

    protected $description = 'Ban a user temporarily or permanently';

    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (!$user) {
            $this->error('User not found.');
            return self::FAILURE;
        }

        if (in_array($user->role, ['admin', 'developer'])) {
            $this->error('Admin and developer accounts cannot be banned.');
            return self::FAILURE;
        }

        $days = $this->argument('days');

        $user->update([
            'status' => 'banned',
            'status_until' => $days
                ? now()->addDays(max(1, (int) $days))
                : null,
        ]);

        if ($days) {
            $this->info("{$user->name} has been banned for {$days} days.");
        } else {
            $this->info("{$user->name} has been permanently banned.");
        }

        return self::SUCCESS;
    }
}