<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $data = ContactRequest::latest()->paginate(25);

        return view('admin.contact.contact-requests')->with([
            'pageName' => 'Contact Requests',
            'data' => $data,
        ]);
    }

}
