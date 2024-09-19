<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;


class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.layouts.master');
    }
    public function contactRequests() {

        $data = ContactRequest::latest()->paginate(10);

        return view('admin.contact-requests')->with([
            'pageName' => 'Contact Requests',
            'data' => $data,
        ]);
    }

}