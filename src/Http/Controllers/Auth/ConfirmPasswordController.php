<?php

namespace App\Http\Controllers\dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ConfirmPasswordController extends Controller
{

    protected $redirectTo = 'dashboard/home';

    public function showConfirmForm()
    {
        return view('dashboard.auth.passwords.confirm');
    }

    public function confirm(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $this->resetPasswordConfirmationTimeout($request);

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }

    protected function validationErrorMessages()
    {
        return [];
    }

    protected function resetPasswordConfirmationTimeout(Request $request)
    {
        $request->session()->put('auth.password_confirmed_at', time());
    }

    protected function rules()
    {
        return [
            'password' => 'required|password',
        ];
    }

    public function redirectPath()
    {
        return 'dashboard/home';
    }
}
