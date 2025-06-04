<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Anuncio;

class AnuncioFactory extends Factory
{
    protected $model = Anuncio::class;

    public function definition()
    {
        return [
            'titulo'         => $this->faker->sentence(3),
            'descricao'      => $this->faker->paragraph(),
            'marca'          => $this->faker->randomElement(['Ford','Chevrolet','Fiat','Volkswagen']),
            'modelo'         => $this->faker->word(),
            'ano_modelo'     => $this->faker->numberBetween(2000, 2024),
            'ano_fabricacao' => $this->faker->numberBetween(2000, 2024),
            'combustivel'    => $this->faker->randomElement(['Gasolina','Álcool','Flex','Diesel']),
            'cor'            => $this->faker->safeColorName(),
            'preco'          => $this->faker->randomFloat(2, 10000, 100000),
            'localizacao'    => $this->faker->city(),
            'quilometragem'  => $this->faker->numberBetween(0, 200000),
            'portas'         => $this->faker->numberBetween(2, 5),
            'placa'          => strtoupper($this->faker->bothify('??-####')),
            'situacao'       => $this->faker->randomElement(['novo','usado','seminovo']),
            'detalhes'       => $this->faker->sentence(),
            'opcionais'      => implode(', ', $this->faker->words(3)),
            'observacoes'    => $this->faker->sentence(),
            'status'         => 'ativo',
        ];
    }
}
