<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Caso não exista um usuário com esse e-mail, crie um:
        $email = 'admin@admin.com';

        User::firstOrCreate(
            ['email' => $email],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('12345678'), // troque para algo seguro
                // se você ainda estiver usando is_admin:
                // 'is_admin' => true,
            ]
        );
    }
}
