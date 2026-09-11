<?php

namespace App\Http\Controllers;

use App\Models\Profile;

class UserFollowListController extends Controller
{
    /**
     * Show a user's followers.
     */
    public function followers(string $username)
    {
        $profile = Profile::with([
            'user.followers.profile',
        ])
            ->where('username', $username)
            ->firstOrFail();

        $users = $profile->user
            ->followers()
            ->with('profile')
            ->latest('user_follows.created_at')
            ->get();

        return view('profile.followers', compact(
            'profile',
            'users'
        ));
    }

    /**
     * Show users that this user is following.
     */
    public function following(string $username)
    {
        $profile = Profile::with([
            'user.following.profile',
        ])
            ->where('username', $username)
            ->firstOrFail();

        $users = $profile->user
            ->following()
            ->with('profile')
            ->latest('user_follows.created_at')
            ->get();

        return view('profile.following', compact(
            'profile',
            'users'
        ));
    }
}