<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\AuthRequest;

class AuthController extends Controller
{


    public function index() {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.index');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('admin.index');
        } else {
            session()->flash('error', 'Credentials are incorrect.');
            return back();
        }
    }


    public function logout() {
        if (!auth()->guard('admin')->check()) {
            return redirect()->to('/login');
        }
        Auth::guard('admin')->logout();
        return redirect()->to('/login');
    }
}
