<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {

            $user = Auth::user();
            $token = $user->createToken('Laravel_backend_movies_API')->plainTextToken;

            return response(['user' => $user, 'token' => $token]);
        }

        abort(403);
    }

    public function register(UserRegisterRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'name' => $validated['name'],
        ]);
        $token = $user->createToken('Laravel_backend_movies_API')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        return $request->user()->currentAccessToken()->delete();
    }

    public function logoutAllDevices()
    {
        return auth()->user()->tokens()->delete();
    }
}
