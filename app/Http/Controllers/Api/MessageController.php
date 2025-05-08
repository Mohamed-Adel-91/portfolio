<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewMessageRequest;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(NewMessageRequest $request)
    {
        try {
            $message = Message::create($request->validated());
            return ApiResponse::sendResponse(201, 'Message sent successfully!', [
                'read_status' => false,
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'read_status' => false,
                'errors' => [$e->getMessage()],
            ], 500);
        }
    }
}
