<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    /**
     * Follow a developer.
     */
    public function store(Request $request, User $user)
    {
        $currentUser = $request->user();

        // Prevent following yourself.
        if ($currentUser->id === $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot follow yourself.',
            ], 422);
        }

        $currentUser->following()->syncWithoutDetaching([
            $user->id,
        ]);

        return response()->json([
            'success' => true,
            'following' => true,
            'followers_count' => $user->followers()->count(),
        ]);
    }

    /**
     * Unfollow a developer.
     */
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