<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthApiController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me() {
        return response()->json(Auth::guard('api')->user());
    }

    public function logout() {
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function refresh() {
        return $this->respondWithToken(Auth::guard('api')->refresh());
    }

    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }
}