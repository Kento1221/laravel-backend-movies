<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Services\AuthService;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Login user with email and password. Returns authentication token.
     *
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(UserLoginRequest $request)
    {
        $token = AuthService::login(
            $request->validated()['email'],
            $request->validated()['password']
        );

        return $token != null
            ? response(['token' => $token])
            : response(null, 403);
    }

    /**
     * Login user with email and password. Returns authentication token.
     *
     * @param UserRegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request)
    {
        $token = AuthService::register(
            $request->validated()['email'],
            $request->validated()['password'],
            $request->validated()['name']
        );

        return response(['token' => $token]);
    }

    /**
     * Log out from current session.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        return $request
            ->user()
            ->currentAccessToken()
            ->delete();
    }

    /**
     * Log out all devices assigned to the user's account and return the number of devices logged out.
     *
     * @param UserRegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function logoutAllDevices()
    {
        return auth()
            ->user()
            ->tokens()
            ->delete();
    }
}
