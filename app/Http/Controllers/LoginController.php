<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request) {
        $validated = $request->validated(); 
        if (User::where('email', $validated['email'])->exists()) {
            $user = User::where('email', $validated['email'])->first(); 
            if (Hash::check($validated['password'], $user->password)) {
                $user->tokens()->delete(); 
                return $user->createToken($validated['token_name'])->plainTextToken; 
            }
            return 'incorrect password'; 
        }
    }
}
