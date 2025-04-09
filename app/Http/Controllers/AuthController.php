<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\DocumentValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Registrar um novo usuário
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'cpf_cnpj' => 'required|string|unique:users',
            'address' => 'nullable|string|max:500',
        ]);

        // Validação customizada de CPF ou CNPJ
        if (!DocumentValidator::validateCpfCnpj($validated['cpf_cnpj'])) {
            return response()->json(['error' => 'CPF ou CNPJ inválido.'], 422);
        }

        // Criação do usuário
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'cpf_cnpj' => $validated['cpf_cnpj'],
            'address' => $validated['address'] ?? null,
        ]);

        // Geração do token JWT
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Cadastro realizado com sucesso!',
            'user' => $user,
            'token' => $token
        ], 201);
    }

    /**
     * Autenticar usuário e gerar token
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }

        return response()->json([
            'message' => 'Login realizado com sucesso!',
            'token' => $token,
            'user' => auth()->user()
        ]);
    }

    /**
     * Exibir o formulário de login (caso esteja usando Blade)
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Realizar logout e invalidar o token
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['message' => 'Logout realizado com sucesso']);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Não foi possível fazer o logout'], 500);
        }
    }

    /**
     * Exibir o perfil do usuário autenticado
     */
    public function profile()
    {
        return response()->json(auth()->user());
    }
}
