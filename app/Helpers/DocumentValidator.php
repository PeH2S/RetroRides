<?php

namespace App\Helpers;

class DocumentValidator
{
    public static function validateCpf(string $cpf): bool
    {
        $cpf = preg_replace('/\D/', '', $cpf);

        if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $sum = 0;
            for ($i = 0; $i < $t; $i++) {
                $sum += $cpf[$i] * (($t + 1) - $i);
            }

            $digit = ((10 * $sum) % 11) % 10;

            if ((int) $cpf[$t] !== $digit) {
                return false;
            }
        }

        return true;
    }

    public static function validateCnpj(string $cnpj): bool
    {
        $cnpj = preg_replace('/\D/', '', $cnpj);

        if (strlen($cnpj) !== 14 || preg_match('/^(\d)\1{13}$/', $cnpj)) {
            return false;
        }

        for ($t = 12; $t < 14; $t++) {
            $sum = 0;
            $weight = $t - 7;

            for ($i = 0; $i < $t; $i++) {
                $sum += $cnpj[$i] * $weight--;
                if ($weight < 2) {
                    $weight = 9;
                }
            }

            $digit = ((10 * $sum) % 11) % 10;

            if ((int) $cnpj[$t] !== $digit) {
                return false;
            }
        }

        return true;
    }

    public static function validateCpfCnpj(string $document): bool
    {
        $document = preg_replace('/\D/', '', $document);
        $length = strlen($document);

        return match ($length) {
            11 => self::validateCpf($document),
            14 => self::validateCnpj($document),
            default => false,
        };
    }
}
