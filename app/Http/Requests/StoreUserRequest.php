<?php

namespace App\Http\Requests;

use App\Helpers\DocumentValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isJuridica = $this->input('is_juridica') == '1';

        $rules = [
            'is_juridica' => ['required', 'boolean'],
            'cpf_cnpj' => [
                'required',
                'string',
                Rule::unique('users', 'cpf_cnpj'),
                function ($attribute, $value, $fail) {
                    $cleaned = preg_replace('/\D/', '', $value);
                    if (!DocumentValidator::validateCpfCnpj($cleaned)) {
                        $fail('Documento (CPF ou CNPJ) inválido.');
                    }
                },
            ],
            'address' => ['required', 'string', 'max:500'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        if ($isJuridica) {
            $rules += [
                'company_name' => ['required', 'string', 'max:100'],
                'company_email' => ['required', 'email', 'max:150', Rule::unique('users', 'email')],
                'company_phone' => ['required', 'string', 'max:20'],
                'fantasy_name' => ['nullable', 'string', 'max:100'],
                'state_registration' => ['nullable', 'string', 'max:50'],
            ];
        } else {
            $rules += [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'email', 'max:150', Rule::unique('users', 'email')],
                'phone' => ['required', 'string', 'max:20'],
                'birth_date' => ['nullable', 'date'],
                'rg' => ['nullable', 'string', 'max:20'],
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'is_juridica.required' => 'O tipo de pessoa é obrigatório.',
            'cpf_cnpj.required' => 'O CPF ou CNPJ é obrigatório.',
            'cpf_cnpj.unique' => 'Este CPF/CNPJ já está cadastrado.',
            'address.required' => 'O endereço é obrigatório.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve conter no mínimo 8 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',

            // Pessoa Física
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'phone.required' => 'O telefone é obrigatório.',

            // Pessoa Jurídica
            'company_name.required' => 'A razão social é obrigatória.',
            'company_email.required' => 'O e-mail da empresa é obrigatório.',
            'company_email.email' => 'O e-mail da empresa deve ser válido.',
            'company_email.unique' => 'Este e-mail já está cadastrado.',
            'company_phone.required' => 'O telefone da empresa é obrigatório.',
        ];
    }
}
