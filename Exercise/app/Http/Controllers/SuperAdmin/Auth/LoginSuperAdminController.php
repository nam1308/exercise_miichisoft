<?php

namespace App\Http\Controllers\SuperAdmin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\Super_Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
class LoginSuperAdminController extends Controller
{
    //
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest:super-admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('super-admin');
    }

    public function showLoginForm()
    {
        $this->guard()->logout();
        return view('super-admin.auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (
            method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)
        ) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }


        if ($this->guard()->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect()->route('super-admin.home');
        } else {
            $this->incrementLoginAttempts($request);
            return back()->with('error_message', 'Email hoặc mật khẩu k chính xác');
        }
        return back();
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->guard()->logout();
        return $this->loggedOut($request);
    }

    public function loggedOut(Request $request): RedirectResponse
    {
        return redirect(route('super-admin.login'));
    }
}
