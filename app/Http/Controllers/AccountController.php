<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class AccountController extends Controller
{
    /**
     * Display the "Minha Conta" tab inside the dashboard.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('pages.dashboard', compact('user'))
            ->with('tab', 'account');
    }

    /**
     * Process and save the form submission from "Minha Conta".
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'email'      => 'required|email|unique:users,email,' . $user->id,
            'name'       => 'required|string|max:255',
            'gender'     => 'nullable|in:masculino,feminino,outro',
            'birthdate'  => 'nullable|date_format:d/m/Y',
            'cpf'        => 'nullable|string|max:14',
            'cep'        => 'nullable|string|size:9',
            'state'      => 'nullable|string|size:2',
            'city'       => 'nullable|string|max:100',
            'phone'      => 'nullable|string|max:20',
            // removed show_phone validation here
        ]);

        // Convert birthdate to DB format
        if (!empty($data['birthdate'])) {
            $data['birthdate'] = Carbon::createFromFormat('d/m/Y', $data['birthdate'])
                                        ->format('Y-m-d');
        }

        // Strip non-digits
        foreach (['cpf', 'cep', 'phone'] as $field) {
            if (!empty($data[$field])) {
                $data[$field] = preg_replace('/\D/', '', $data[$field]);
            }
        }

        // Checkbox: 1 if checked, 0 if not
        $data['show_phone'] = $request->has('show_phone') ? 1 : 0;

        // Auto-fill state/city via ViaCEP if CEP provided
        if (!empty($data['cep'])) {
            $response = Http::get("https://viacep.com.br/ws/{$data['cep']}/json/");
            if ($response->ok() && empty($response->json('erro'))) {
                $data['state'] = $response->json('uf');
                $data['city']  = $response->json('localidade');
            }
        }

        // Update user record
        $user->update([
            'email'      => $data['email'],
            'name'       => $data['name'],
            'gender'     => $data['gender']    ?? null,
            'birthdate'  => $data['birthdate'] ?? null,
            'cpf'        => $data['cpf']       ?? null,
            'cep'        => $data['cep']       ?? null,
            'state'      => $data['state']     ?? null,
            'city'       => $data['city']      ?? null,
            'phone'      => $data['phone']     ?? null,
            'show_phone' => $data['show_phone'],
        ]);

        return redirect()
            ->route('dashboard.account')
            ->with('success', 'Dados atualizados com sucesso!');
    }
}
