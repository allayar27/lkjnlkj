<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use App\Http\Requests\Auth\SignUpFormRequest;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    public function register(SignUpFormRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);
        $user->assignRole('user');

        return response([
            'token' => $user->createToken('api_token')->plainTextToken,
            'user' => $user
        ]);

    }

    public function login(LoginFormRequest $request)
    {
        $valid = $request->validated();

        $user = User::whereEmail($request->email)->first();
        if (!auth()->attempt($valid)) {
            return $this->error('Credentials not match', Response::HTTP_UNAUTHORIZED);
        }
 
        return response([
            'token' => $user->createToken('API Token')->plainTextToken,
            'user_name' => $user->name,
            'role' => $user->getRoleNames()
        ]);

    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
        return response([
            'message' => 'Tokens Revoked'
        ]);
    }
}
