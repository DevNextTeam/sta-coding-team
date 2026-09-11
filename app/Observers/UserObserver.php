<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Str;

class UserObserver
{
    public function created(User $user): void
    {
        $baseUsername = Str::slug($user->name);

        if ($baseUsername === '') {
            $baseUsername = 'user';
        }

        $username = $baseUsername;
        $counter = 2;

        while ($user->profile()->where('username', $username)->exists()) {
            $username = $baseUsername . '-' . $counter;
            $counter++;
        }

        $user->profile()->create([
            'username' => $username,
            'headline' => 'User',
        ]);
    }
}