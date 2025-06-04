<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // importa corretamente o facade Hash

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cria um usuário administrador com senha “123”
        User::factory()->create([
            'name'     => 'Admin',
            'email'    => 'adm@adm.com',
            'password' => Hash::make('123')  // CORRETO: Hash::make em vez de Hash('123')
        ]);

        // Chama outros seeders (ex.: o seeder de anúncios)
        $this->call(AnuncioSeeder::class);
    }
}
