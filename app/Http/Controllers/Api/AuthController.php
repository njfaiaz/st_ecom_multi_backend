<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Enums\UserRole;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {

            $validator = Validator::make($request->all(),
            [
                'first_name' => 'required|string|min:3|max:100',
                'last_name' => 'required|string|min:3|max:100',
                'email' => 'required|email|unique:users|max:100',
                'password' => 'required|min:6|confirmed'
            ]);

            if($validator->fails()){
                return errorResponse($validator->errors()->first(), 422);
            }

            $username = Str::slug($request->first_name.'.'.$request->last_name, '-');

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $username,
                'email' => $request->email,
                'role' => UserRole::CUSTOMER->value,
                'password' => Hash::make($request->password)
            ]);

            $response['token'] = $user->createToken("API TOKEN")->plainTextToken;

            return apiResponse($response, 'Registration Successful', 201);

        } catch (\Throwable $th) {

            return errorResponse($th->getMessage(), 500);
        }
    }


    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users|max:100',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return errorResponse($validator->errors()->first(), 422);
        }

        if(!Auth::attempt($request->only(['email', 'password']))){

            return errorResponse('Incorrect password', 422);
        }

        $user = User::where('email', $request->email)->first();

        $response['user'] = UserResource::make($user);
        $response['token'] = $user->createToken("API TOKEN")->plainTextToken;

        return apiResponse($response, 'Login Successful', 200);
    }



    public function logout(){

        Auth::user()->tokens()->delete();

        return apiResponse([], 'Logged out successfully');
    }
}
