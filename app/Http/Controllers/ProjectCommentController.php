<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectComment;
use Illuminate\Http\Request;

class ProjectCommentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Store Comment
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $comment = $project->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $validated['body'],
        ]);

        $comment->load('user.profile');

        return $this->commentResponse(
            $request,
            $comment,
            'Comment posted successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update Comment
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, ProjectComment $comment)
    {
        $this->authorizeComment($request, $comment);

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $comment->update([
            'body' => $validated['body'],
        ]);

        $comment->load('user.profile');

        return $this->commentResponse(
            $request,
            $comment,
            'Comment updated successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Comment
    |--------------------------------------------------------------------------
    */

    public function destroy(Request $request, ProjectComment $comment)
    {
        $this->authorizeComment($request, $comment);

        $project = $comment->project;

        $comment->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Comment deleted successfully.',
                'comment_count' => $project->comments()->count(),
            ]);
        }

        return back()->with(
            'success',
            'Comment deleted successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Authorization
    |--------------------------------------------------------------------------
    */

    private function authorizeComment(
        Request $request,
        ProjectComment $comment
    ): void {
        abort_unless(
            $comment->user_id === $request->user()->id,
            403
        );
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX / Normal Response
    |--------------------------------------------------------------------------
    */

    private function commentResponse(
        Request $request,
        ProjectComment $comment,
        string $message
    ) {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,

                'comment' => [
                    'id' => $comment->id,
                    'user_id' => $comment->user_id,
                    'user_name' => $comment->user->name,

                    'username' => $comment->user->profile?->username,

                    'avatar' => $comment->user->profile?->avatar,

                    'body' => $comment->body,

                    'created_at' => $comment->created_at
                        ->diffForHumans(),
                ],

                'comment_count' => $comment->project
                    ->comments()
                    ->count(),
            ]);
        }

        return back()->with('success', $message);
    }
}
