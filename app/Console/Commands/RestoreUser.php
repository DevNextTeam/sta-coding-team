<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class RestoreUser extends Command
{
    protected $signature = 'user:restore {email}';

    protected $description = 'Restore a suspended or banned user';

    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (!$user) {
            $this->error('User not found.');
            return self::FAILURE;
        }

        $user->update([
            'status' => 'active',
            'status_until' => null,
        ]);

        $this->info("{$user->name}'s account has been restored.");

        return self::SUCCESS;
    }
}