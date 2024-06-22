<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use App\Models\NewsletterRequest;

class DashboardController extends Controller
{
    public function contactRequests() {

        $data = ContactRequest::latest()->paginate(10);

        return view('admin.contact-requests')->with([
            'pageName' => 'Contact Requests',
            'data' => $data,
        ]);
    }
    public function getInTouchRequests() {

        $data = NewsletterRequest::latest()->paginate(10);

        return view('admin.get-in-touch-requests')->with([
            'pageName' => 'Newsletter Requests',
            'data' => $data,
        ]);
    }


}