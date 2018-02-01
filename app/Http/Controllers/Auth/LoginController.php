<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use guard;
use Illuminate\Http\Request;
use App\Common\Roles;
use Session;
use App\User;
use Hash;
use Auth;
use Lang;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required', 'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $credentials['role_id'] = Roles::ROLE_ADMIN;
        $user = User::where('email', $credentials['email'])
            ->where('role_id', $credentials['role_id'])
            ->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
                return redirect()->intended(route('admin.get_home'));
            }
        }
        return redirect('/login')
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
            ? Lang::get('auth.failed')
            : 'These credentials do not match our records.';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        Session::flush();
        return back();
    }
}
