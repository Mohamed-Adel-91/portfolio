<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FormsController extends Controller
{

    public function contactUsRequest(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|string|max:255',
                'role' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'mobile' => ['required', 'regex:/^(\+?\d{1,3}|\d{1,4})?\s?\d{7,10}$/'],
                'country' => 'required|string|max:255',
                'website' => 'required|url',
                'details' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()->all(),
                ]);
            }

            $contactUs = ContactRequest::create([
                'full_name' => $request->full_name,
                'role' => $request->role,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country' => $request->country,
                'website' => $request->website,
                'details' => $request->details,
            ]);

            return response()->json([
                'status' => true,
                'errors' => [],
                'contactUs' => $contactUs,
            ]);
        } catch (\Exception $e) {
            Log::error('Contact form submission error: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'errors' => [$e->getMessage()],
            ], 500);
        }
    }
}
