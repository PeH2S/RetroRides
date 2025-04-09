<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\DocumentValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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
        // Validação das credenciais
        $credentials = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Log para verificar as credenciais recebidas
        Log::info('Tentando autenticar usuário', ['email' => $credentials['email']]);

        try {
            // Tentativa de autenticação com JWT
            if (!$token = JWTAuth::attempt($credentials)) {
                Log::error('Credenciais inválidas', ['credentials' => $credentials]);
                return response()->json([
                    'error' => 'Credenciais inválidas',
                ], 401);
            }

            // Obtenção do usuário autenticado
            $user = auth()->user();
            Log::info('Usuário autenticado', ['user' => $user]);

            // Retorno do sucesso com o token e dados do usuário
            return response()->json([
                'message' => 'Login realizado com sucesso!',
                'token' => $token,
                'user' => $user,
            ]);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            // Erro ao gerar o token JWT
            Log::error('JWTException: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->json([
                'error' => 'Erro ao gerar token',
            ], 500);
        } catch (\Exception $e) {
            // Erro desconhecido
            Log::error('Exception: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            return response()->json([
                'error' => 'Erro desconhecido ao tentar autenticar',
            ], 500);
        }
    }
    /**
     * Realizar logout e invalidar o token
     */
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json(['message' => 'Logout realizado com sucesso']);
        } catch (JWTException $e) {
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

    /**
     * Exibir o formulário de login (caso esteja usando Blade)
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Isso vai buscar resources/views/auth/login.blade.php
    }
}
