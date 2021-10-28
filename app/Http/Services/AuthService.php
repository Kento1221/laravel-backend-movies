<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    /**
     * Login user with email and password. Returns authentication token.
     *
     * @param string $email
     * @param string $password
     * @return string
     */
    public static function login($email, $password)
    {
        if (Auth::attempt([
            'email' => $email,
            'password' => $password,
        ])) {
            return Auth::user()
                ->createToken('Laravel_backend_movies_API')
                ->plainTextToken;
        }

        return null;
    }

    /**
     * Register user with email, password and name and retrieve valid authentication token.
     *
     * @param string $email
     * @param string $password
     * @param string $name
     * @return string
     */
    public static function register($email, $password, $name)
    {
        $user = User::create([
            'email' => $email,
            'password' => bcrypt($password),
            'name' => $name,
        ]);

        return $user
            ->createToken('Laravel_backend_movies_API')
            ->plainTextToken;
    }
}
