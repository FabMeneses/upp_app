<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validación de los datos de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Intentar autenticar al usuario
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Obtener al usuario autenticado
            $user = Auth::user();

            // Generar el token usando Sanctum
            $token = $user->createToken('MyApp')->plainTextToken;

            // Responder con el token y el usuario
            return response()->json([
                'token' => $token,
                'user' => new UserResource($user)
            ]);
        }

        // Si no se puede autenticar, responder con un error 401
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
