<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\DocumentValidator;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 
        'cpf_cnpj', 'address', 'email_verified_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['formatted_cpf_cnpj'];

    /**
     * Mutator para o campo password (hash automático)
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Mutator para o campo cpf_cnpj (limpa formatação)
     */
    public function setCpfCnpjAttribute($value)
    {
        $this->attributes['cpf_cnpj'] = preg_replace('/[^0-9]/', '', $value);
    }

    /**
     * Accessor para CPF/CNPJ formatado
     */
    public function getFormattedCpfCnpjAttribute()
    {
        if (strlen($this->cpf_cnpj) === 11) {
            return substr($this->cpf_cnpj, 0, 3) . '.' . 
                   substr($this->cpf_cnpj, 3, 3) . '.' . 
                   substr($this->cpf_cnpj, 6, 3) . '-' . 
                   substr($this->cpf_cnpj, 9, 2);
        } elseif (strlen($this->cpf_cnpj) === 14) {
            return substr($this->cpf_cnpj, 0, 2) . '.' . 
                   substr($this->cpf_cnpj, 2, 3) . '.' . 
                   substr($this->cpf_cnpj, 5, 3) . '/' . 
                   substr($this->cpf_cnpj, 8, 4) . '-' . 
                   substr($this->cpf_cnpj, 12, 2);
        }
        return $this->cpf_cnpj;
    }

    /**
     * Valida o CPF/CNPJ antes de salvar
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($user) {
            if (!DocumentValidator::validateCpfCnpj($user->cpf_cnpj)) {
                throw new \Exception('CPF/CNPJ inválido');
            }
        });
    }

    // Métodos JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'user' => [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'document' => $this->formatted_cpf_cnpj
            ]
        ];
    }

    /**
     * Scope para busca por documento
     */
    public function scopeByDocument($query, $document)
    {
        $cleaned = preg_replace('/[^0-9]/', '', $document);
        return $query->where('cpf_cnpj', $cleaned);
    }
}