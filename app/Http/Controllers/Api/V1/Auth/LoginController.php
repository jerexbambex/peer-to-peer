<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class LoginController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        if(!Auth::attempt($attributes)) {
            $data = [
                'status' => 'unsuccessful',
                'error' => "Sorry, the credentials doesn't match our record",
            ];
            return response()->json(['data' => $data], 401);
        }

        $authToken = Auth::user()->createToken('Auth Token')->accessToken;

        $data = [
            'status' => "success",
            'message' => "Login Successful!!!",
            // 'user' => new UserResource(Auth::user()),
            'authToken' => $authToken,
        ];

        return response()->json(['data' => $data], 202);
    }

    public function loginWithSocialMedia(Request $request): JsonResponse
    {
        $attributes = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'provider_name' => 'required',
        ]);

        $existingUser = User::where('email', $attributes['email'])->first();

        if($existingUser){
            Auth::login($existingUser);
            $authToken = Auth::user()->createToken('Auth Token')->accessToken;

            $data = [
                'status' => "success",
                'message' => "Login Successful!!!",
                'user' => new UserResource(Auth::user()),
                'authToken' => $authToken,
            ];

            return response()->json(['data' => $data], 202);
        }

        $user = User::create($attributes);

        event(new Registered($user));
        Auth::login($user);
        $authToken = Auth::user()->createToken('Auth Token')->accessToken;

        $data = [
            'status' => "success",
            'message' => "Login Successful!",
            'user' => $user,
            'authToken' => $authToken,
        ];

        return response()->json(['data' => $data], 201);
    }
}
