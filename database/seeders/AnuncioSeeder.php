<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anuncio;
use App\Models\User;
use App\Models\AnuncioFoto;

class AnuncioSeeder extends Seeder
{
    public function run(): void
    {
        // Para cada usuário, cria de 1 a 3 anúncios de exemplo
        User::factory(5)->create()->each(function ($user) {
            Anuncio::factory(rand(1, 3))->create([
                'user_id' => $user->id,
            ])->each(function ($anuncio) {
                // Cria uma foto “placeholder” para cada anúncio
                $fakeCaminho = 'anuncios/sem-imagem.jpg';
                AnuncioFoto::create([
                    'anuncio_id' => $anuncio->id,
                    'caminho'    => $fakeCaminho,
                    'principal'  => true,
                    'ordem'      => 1,
                ]);
            });
        });
    }
}
