<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $profile = auth()->user();

        return apiResourceResponse(UserResource::make($profile));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'min:2'],
            'last_name' => ['required', 'string', 'min:2'],
            'username' => ['required', 'string', 'min:2'],
            'phone' => ['required', 'regex:/[0-9]/', 'max:11'],
            'email' => ['required', 'email','exists:users,email'],
        ]);
        if ($validator->fails()) {
            return  errorResponse($validator->errors()->first(), 422);
        }
        $user = auth()->user();
        $input = $validator->validated();
        $user->update($input);

        return  apiResourceResponse(UserResource::make(auth()->user()), 'Your profile update successfully');
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'min:6'],
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['min:6'],
        ]);

        if ($validator->fails()) {
            return  errorResponse($validator->errors()->first(), 422);
        }

        $user = auth()->user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->update(['password' => Hash::make($request->password)]);
        } else {
            return  errorResponse('Old password is wrong', 401);
        }

        return successResponse('Password Update successfully');
    }
}
