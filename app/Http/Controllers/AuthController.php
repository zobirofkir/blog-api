<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Register New User
     */
    public function register(RegisterRequest $request) : RegisterResource
    {
        return RegisterResource::make(
            User::create(
                $request->validated()
            )
        );
    }

    /**
     * Login The User
     */
    public function login(LoginRequest $request) : LoginResource
    {
        $validatedData = $request->validated();
        $user = User::where('email', $validatedData['email'])->first();

        if (!$user || !Hash::check($validatedData['password'], $user->password)) {
            abort(401);
        }

        return LoginResource::make($user);
    }

    /**
     * Logout The User
     */
    public function logout() : bool
    {
        Auth::user()->token()->revoke();
        return true;
    }
}
