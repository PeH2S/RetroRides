<?php

namespace App\Http\Requests;

use App\Helpers\DocumentValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Autoriza esta requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação para o formulário de cadastro de usuários.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150', Rule::unique('users')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:20'],
            'cpf_cnpj' => [
                'required',
                'string',
                Rule::unique('users'),
                function ($attribute, $value, $fail) {
                    $cleaned = preg_replace('/\D/', '', $value);

                    if (!DocumentValidator::validateCpfCnpj($cleaned)) {
                        $fail('Documento (CPF ou CNPJ) inválido.');
                    }
                }
            ],
            'address' => ['required', 'string', 'max:500'],
        ];
    }

    /**
     * Mensagens personalizadas de erro.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'A senha é obrigatória.',
            'password.confirmed' => 'As senhas não coincidem.',
            'phone.required' => 'O telefone é obrigatório.',
            'cpf_cnpj.required' => 'O CPF ou CNPJ é obrigatório.',
            'cpf_cnpj.unique' => 'Este CPF/CNPJ já está cadastrado.',
            'address.required' => 'O endereço é obrigatório.',
        ];
    }
}
