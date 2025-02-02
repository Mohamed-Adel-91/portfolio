<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsReplyRequest;
use App\Models\ContactRequest;
use Illuminate\Support\Facades\Log;

class ContactUsController extends Controller
{
    public function index()
    {
        $data = ContactRequest::latest()->paginate(10);

        return view('admin.contact.contact-requests')->with([
            'pageName' => 'Contact Requests',
            'data' => $data,
        ]);
    }

    public function replyToContactRequest(ContactUsReplyRequest $request)
    {
        try {
            $contactRequest = ContactRequest::findOrFail($request->contact_request_id);

            $contactRequest->replays()->create([
                'reply_message' => $request->reply_message,
            ]);

            if ($contactRequest->reply_status == 0) {
                $contactRequest->update(['reply_status' => 1]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Reply sent successfully!',
            ]);
        } catch (\Exception $e) {
            Log::error('Reply submission error: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'errors' => [$e->getMessage()],
            ], 500);
        }
    }
}
