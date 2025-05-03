<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\ContactRequest;
use App\Models\Intro;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function index()
    {
        $intro = Intro::first();
        $about = About::first();
        $settings = Setting::first();
        return view('web.layouts.master')->with([
            'pageName' => 'Mohamed Adel - Personal Portfolio Website',
            'intro' => $intro,
            'about' => $about,
            'settings' => $settings,
        ]);
    }

    public function contactUs()
    {
        return view('web.contact-us')->with([
            'pageName' => 'Contact Me',
        ]);
    }

    public function submitContactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all(),
            ]);
        }

        $contactRequest = ContactRequest::create($validator->validated());

        return response()->json([
            'status' => true,
            'errors' => [],
            'contactRequest' => $contactRequest,
        ]);
    }
}
