<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'The given data was invalid',
                'errors' => [
                    'password' => [
                        'Invalid credentials'
                    ]
                ]
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        $authToken = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'token' => $authToken,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {


        // Find the token from the request
        $accessToken = $request->bearerToken();
        // Find the token in the database
        $token = PersonalAccessToken::findToken($accessToken);
        // Delete the token from the database
        $token->delete();

        return response()->json([
            'message' => 'User logged out'
        ]);
    }
}
