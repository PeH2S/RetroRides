<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Exibe o formulário de cadastro de usuários.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Armazena um novo usuário no banco de dados.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        // Limpa CPF/CNPJ, mantendo apenas números
        $cleanedCpfCnpj = preg_replace('/\D/', '', $validatedData['cpf_cnpj']);

        // Cria o usuário com os dados validados
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'cpf_cnpj' => $cleanedCpfCnpj,
            'address' => $validatedData['address'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Redireciona para o formulário com mensagem de sucesso
        return redirect()
            ->route('users.create')
            ->with('success', 'Usuário cadastrado com sucesso!');
    }
}
