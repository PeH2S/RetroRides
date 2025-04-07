<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create'); // Mostra o formulário
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:20',
            'cpf_cnpj' => 'required|string|unique:users|regex:/^\d{11,14}$/', // Apenas números, entre 11 e 14 dígitos
            'address' => 'required|string|max:500',
            'password' => 'required|string|min:8|confirmed', // Validação da senha
        ]);
        // Remove caracteres não numéricos do CPF/CNPJ antes de salvar
        $cpf_cnpj = preg_replace('/\D/', '', $request->cpf_cnpj);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cpf_cnpj' => $cpf_cnpj, // Apenas números
            'address' => $request->address,
            'password' => bcrypt($request->password), // Criptografando a senha
        ]);

        // Salvar usuário no banco
        User::create($request->all());

        // Redireciona com mensagem de sucesso
        return redirect()->route('users.create')->with('success', 'Usuário cadastrado com sucesso!');
    }
}
