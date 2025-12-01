<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */

    public function index()
    {
        if (auth()->guard('admin')->check()) {
            return redirect()->route('admin.index');
        }

        return view('admin.login');
    }

    /**
     * Handle login logic with AuthRequest validation.
     *
     * @param \App\Http\Requests\AuthRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(AuthRequest $request)
    {

        if (auth()->guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']])) {
            return redirect()->route('admin.index');
        } else {
            session()->flash('error', 'Credentials are incorrect.');
            return back();
        }
    }


    /**
     * Log the admin user out.
     *
     * @return \Illuminate\Http\RedirectResponse
     */    public function logout()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->to('/login');
        }
        Auth::guard('admin')->logout();
        return redirect()->to('/login');
    }
}
