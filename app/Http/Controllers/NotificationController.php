<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Mark all unread notifications as read
        $user->unreadNotifications->markAsRead();

        // Get notifications for display
        $notifications = $user
            ->notifications()
            ->latest()
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    public function read(Request $request, string $notification)
    {
        $user = $request->user();

        $user->notifications()
            ->where('id', $notification)
            ->update([
                'read_at' => now(),
            ]);

        return back();
    }

    public function readAll(Request $request)
    {
        $request->user()
            ->unreadNotifications()
            ->update([
                'read_at' => now(),
            ]);

        return back();
    }
}
