<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function username()
    {
        return 'username';
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password');
    }

    protected function authenticated(Request $request, $user)
    {
    // Retrieve the user's information including the contact details
    $userWithContact = User::with('contact')->find($user->id);

    // Set the session variables
    session(['user_fullname' => $userWithContact->contact->first_name . ' ' . $userWithContact->contact->last_name]);
    session(['user_profile_picture' => $userWithContact->contact->profile_picture_path]);

        if ($user->user_type === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->user_type === 'tenant') {
            return redirect('/tenant/dashboard');
        } elseif ($user->user_type === 'personnel') {
            return redirect('/personnel/dashboard');
        } else {
            return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
