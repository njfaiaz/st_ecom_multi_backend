<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if($user->role != 3 )
        {
            return redirect()->back()->withInput()->with('error', 'Please try with different email!');
        }

        if (!Auth::attempt( $credentials))
        {
            return redirect()->back()->withInput()->with('error', 'Incorrect Password');
        }

        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
