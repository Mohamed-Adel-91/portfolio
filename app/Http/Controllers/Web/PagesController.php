<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\ContactRequest;
use App\Models\Intro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{

    public function index()
    {
        $intro = Intro::first();
        $about =  About::first();

        return view('web.layouts.master')->with([
            'pageName' => 'Portfolio | Mohamed Adel',
            'intro' => $intro,
            'about' => $about,
        ]);
    }

    public function contactUs()
    {

        return view('web.contact-us')->with([
            'pageName' => 'Air Master | Contact Us',
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
