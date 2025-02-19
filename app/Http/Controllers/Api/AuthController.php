<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = user::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Username atau password salah'
            ], 401);
        }

        $token = $user->createToken('user-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'data' => [
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'phone' => $user->phone,
                    'email' => $user->email,
                ]
            ]
        ]);
    }

    public function logout(Request $request)
    {
        if (!$request->user()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthenticated'
            ], 401);
        }

        try {
            $userId = $request->user()->id;
            $request->user()->currentAccessToken()->delete();

            Log::info('User logged out successfully', ['user_id' => $userId]);

            return response()->json([
                'status' => 'success',
                'message' => 'Logout berhasil'
            ]);
        } catch (\Exception $e) {
            Log::error('Error during logout', [
                'user_id' => $request->user()->id ?? null,
                'ip' => $request->ip(),
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Logout gagal, silakan coba lagi'
            ], 500);
        }
    }
}
