<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewFollowerNotification;
use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function store(Request $request, User $user)
    {
        $currentUser = $request->user();

        if ($currentUser->id === $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot follow yourself.',
            ], 422);
        }

        $alreadyFollowing = $currentUser->following()
            ->where('users.id', $user->id)
            ->exists();

        $currentUser->following()->syncWithoutDetaching([
            $user->id,
        ]);

        if (!$alreadyFollowing) {
            $currentUser->load('profile');

            $user->notify(
                new NewFollowerNotification($currentUser)
            );
        }

        return response()->json([
            'success' => true,
            'following' => true,
            'followers_count' => $user->followers()->count(),
        ]);
    }

    public function destroy(Request $request, User $user)
    {
        $currentUser = $request->user();

        $currentUser->following()->detach($user->id);

        return response()->json([
            'success' => true,
            'following' => false,
            'followers_count' => $user->followers()->count(),
        ]);
    }
}