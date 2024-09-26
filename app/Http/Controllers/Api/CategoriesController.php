<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;

class CategoriesController extends Controller
{
    public function index(){
        $data = ContactRequest::get();

        return response()->json($data);
    }
    
}