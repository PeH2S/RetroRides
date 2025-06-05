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
        User::factory()->create([

            'name' => 'Admin',
            'email' => 'adm@adm.com',
            'password' => Hash::make('123')
        ]);


        $this->call([
                AnuncioSeeder::class,
            ]);

    }
}
