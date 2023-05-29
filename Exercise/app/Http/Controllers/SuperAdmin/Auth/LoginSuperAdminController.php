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
        $this->middleware('guest:superAdmin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('superAdmin');
    }

    public function showLoginForm()
    {
        $this->guard()->logout();
        return view('superAdmin.auth.login');
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

        $superAdmin = Super_Admin::where('email', $data['email'])->first();
        if ($superAdmin->block) {
            $this->incrementLoginAttempts($request);
            return back()->with('error_message', 'id was blocked');
        }
        if ($this->guard()->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect()->route('superAdmin.home');
        } else {
            $this->incrementLoginAttempts($request);
            return back()->with('error_message', 'Email hoặc mật khẩu k chính xác');
        }
//        $this->incrementLoginAttempts($request);
        return back();
    }

    public function logout(Request $request): RedirectResponse
    {
        $this->guard()->logout();
        return $this->loggedOut($request);
    }

    public function loggedOut(Request $request): RedirectResponse
    {
        return redirect(route('superAdmin.login'));
    }
}
