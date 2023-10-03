<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class RegisterController extends Controller
{
    public function signupForm()
    {
        return view('auth.register');
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'phone' => 'required|max:20',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|min:6|max:50',
            'confirm_password' => 'required|same:password'
        ],[
            'confirm_password.same' => 'Password did not match!',
            'confirm_password.required' => 'Confirm password is required!'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag(),
            ]);
        }

        $username = Str::slug($request->first_name.'.'.$request->last_name, '-');
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => 200,
            'messages' => 'Registered Successfully!',
        ]);
    }
}
