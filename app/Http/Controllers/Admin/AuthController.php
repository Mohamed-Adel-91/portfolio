<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
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
        try {
            // Attempt to log the user in as admin
            if (auth()->guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->route('admin.index');
            } else {
                // Handle invalid login attempt
                return back()->withInput()->withErrors(['email' => 'These credentials do not match our records.']);
            }
        } catch (\Exception $e) {
            // Handle general errors
            session()->flash('error', 'An unexpected error occurred. Please try again later.');
            return back()->withInput();
        }
    }

    /**
     * Log the admin user out.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->to('/login');
        }

        Auth::guard('admin')->logout();

        return redirect()->to('/login');
    }
}
