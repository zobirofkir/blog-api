<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use Illuminate\Http\Request;

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
}
