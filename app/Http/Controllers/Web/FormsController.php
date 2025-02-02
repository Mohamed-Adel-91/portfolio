<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactUsRequest;
use App\Models\ContactRequest;
use Illuminate\Support\Facades\Log;

class FormsController extends Controller
{

    public function contactUsRequest(ContactUsRequest $request)
    {
        try {
            $contactUs = ContactRequest::create($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Contact Request submitted successfully!',
                'errors' => [],
                'data' => $contactUs,
            ], 201);

        } catch (\Exception $e) {
            Log::error('Contact form submission error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'errors' => [$e->getMessage()],
            ], 500);
        }
    }
}
