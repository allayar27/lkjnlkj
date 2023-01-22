<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponser;

    public function register(AuthRequest $request)
    {

        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        if ($user['id'] == 1){
            $user->assignRole('super-admin');
        }
        else{
            $user->assignRole('user');
        }

        return $this->success([
            'token' => $user->createToken('api_token')->plainTextToken,
            'user' => $user
        ]);

    }

    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|exists:users',
            'password' => 'required|string|min:8'
        ]);

        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match', 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken,
            'user_name' => $user->name,
            'role' => $user->roles[0]['name']
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
