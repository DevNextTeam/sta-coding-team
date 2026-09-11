<?php

namespace App\Http\Controllers;

use App\Services\AiAssistantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class AiAssistantController extends Controller
{
    public function chat(
        Request $request,
        AiAssistantService $aiAssistant
    ): JsonResponse {
        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'max:4000',
            ],
        ]);

        try {
            $reply = $aiAssistant->chat(
                $validated['message']
            );

            return response()->json([
                'success' => true,
                'reply' => $reply,
            ]);

        } catch (Throwable $e) {

            report($e);

            return response()->json([
                'success' => false,
                'message' => 'DevNext AI is temporarily unavailable.',
            ], 500);
        }
    }
}