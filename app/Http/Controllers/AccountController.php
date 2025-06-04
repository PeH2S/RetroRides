<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Se você tiver relacionamento address: $address = $user->address;
        return view('pages.account.index', compact('user'));
    }

    public function update(Request $request)
{
    $user = Auth::user();

    $data = $request->validate([
        'email'      => 'required|email|unique:users,email,' . $user->id,
        'name'       => 'required|string|max:255',
        'gender'     => 'nullable|in:masculino,feminino,outro',
        'birthdate'  => 'nullable|date',
        'cpf'        => 'nullable|string|max:14',
        'cep'        => 'nullable|string|max:10',
        'state'      => 'nullable|string|max:2',
        'city'       => 'nullable|string|max:100',
        'phone'      => 'nullable|string|max:20',
        'show_phone' => 'nullable|boolean',
    ]);

    // 1. Atualiza apenas campos existentes em users:
    $user->email = $data['email'];
    $user->name  = $data['name'];
    $user->save();

    // 2. Atualiza ou cria registro na tabela profiles:
    $user->profile()->updateOrCreate(
        ['user_id' => $user->id],
        [
            'gender'    => $data['gender'] ?? null,
            'birthdate' => $data['birthdate'] ?? null,
            'cpf'       => $data['cpf'] ?? null,
        ]
    );

    // 3. Atualiza ou cria registro em addresses:
    $user->address()->updateOrCreate(
        ['user_id' => $user->id],
        [
            'cep'   => $data['cep'] ?? null,
            'state' => $data['state'] ?? null,
            'city'  => $data['city'] ?? null,
        ]
    );

    // 4. Atualiza ou cria registro em phones (separado):
    $user->phoneRecord()->updateOrCreate(
        ['user_id' => $user->id],
        [
            'phone'      => $data['phone'] ?? null,
            'show_phone' => $request->has('show_phone') ? 1 : 0,
        ]
    );

    return redirect()->route('minha-conta')
                     ->with('success', 'Dados atualizados com sucesso!');
}

}
