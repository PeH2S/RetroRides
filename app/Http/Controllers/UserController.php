<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(): View
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $isJuridica = $request->input('is_juridica') == '1';
        $cleanedCpfCnpj = preg_replace('/\D/', '', $validated['cpf_cnpj']);

        // Cria o usuário com base no tipo (PF ou PJ)
        $userData = [
            'cpf_cnpj' => $cleanedCpfCnpj,
            'address' => $validated['address'],
            'password' => Hash::make($validated['password']),
        ];

        if ($isJuridica) {
            $userData = array_merge($userData, [
                'company_name' => $validated['company_name'],
                'fantasy_name' => $validated['fantasy_name'] ?? null,
                'company_email' => $validated['company_email'],
                'company_phone' => $validated['company_phone'],
                'state_registration' => $validated['state_registration'] ?? null,
            ]);
        } else {
            $userData = array_merge($userData, [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'birth_date' => $validated['birth_date'] ?? null,
                'rg' => $validated['rg'] ?? null,
            ]);
        }

        User::create($userData);

        return redirect()
            ->route('users.create')
            ->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'cpf_cnpj' => 'required|string|unique:users,cpf_cnpj,' . $user->id,
            'address' => 'nullable|string|max:500',

            // Campos opcionais adicionais
            'birth_date' => 'nullable|date',
            'rg' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:150',
            'fantasy_name' => 'nullable|string|max:150',
            'company_email' => 'nullable|email|max:150',
            'company_phone' => 'nullable|string|max:20',
            'state_registration' => 'nullable|string|max:50',
        ]);

        $cleanedCpfCnpj = preg_replace('/\D/', '', $validated['cpf_cnpj']);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'cpf_cnpj' => $cleanedCpfCnpj,
            'address' => $validated['address'] ?? null,
            'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,

            // Campos adicionais
            'birth_date' => $validated['birth_date'] ?? null,
            'rg' => $validated['rg'] ?? null,
            'company_name' => $validated['company_name'] ?? null,
            'fantasy_name' => $validated['fantasy_name'] ?? null,
            'company_email' => $validated['company_email'] ?? null,
            'company_phone' => $validated['company_phone'] ?? null,
            'state_registration' => $validated['state_registration'] ?? null,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }
}
