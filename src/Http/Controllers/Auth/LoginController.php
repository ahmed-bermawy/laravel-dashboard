<?php

namespace App\Http\Controllers\dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\dashboard\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = 'dashboard/home';

    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],
            $request->get('remember'))) {
            return redirect()->intended('dashboard/home');
        }
        return back()->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);

    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return  redirect()->to('dashboard/login');
    }
}
