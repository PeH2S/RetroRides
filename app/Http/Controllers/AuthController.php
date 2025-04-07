<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validação dos dados
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Senha de no mínimo 8 caracteres e confirmação
            'phone' => 'nullable|string|max:20', // Ajustado o tamanho para telefone
            'cpf_cnpj' => 'required|string|unique:users', // CPF/CNPJ único
            'address' => 'nullable|string|max:500',
        ]);

        // Criação do usuário
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
            'cpf_cnpj' => $validatedData['cpf_cnpj'],
            'address' => $validatedData['address'],
        ]);

        return response()->json(['message' => 'Cadastro realizado com sucesso!'], 201);
    }

    public function login(Request $request)
    {
        // Validação das credenciais de login
        $credentials = $request->only('email', 'password');

        // Tentativa de autenticação com JWT
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }

        return response()->json(['token' => $token]);
    }

    public function logout()
    {
        // Invalidar o token JWT atual
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function profile()
    {
        // Retornar os dados do usuário autenticado
        return response()->json(auth()->user());
    }
}
