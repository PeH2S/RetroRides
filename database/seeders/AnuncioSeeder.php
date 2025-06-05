<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anuncio;
use Faker\Factory as Faker;

class AnuncioSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('pt_BR');

        $cidades = [
            ['cidade' => 'São Paulo', 'estado' => 'SP', 'latitude' => -23.5505, 'longitude' => -46.6333],
            ['cidade' => 'Rio de Janeiro', 'estado' => 'RJ', 'latitude' => -22.9068, 'longitude' => -43.1729],
            ['cidade' => 'Belo Horizonte', 'estado' => 'MG', 'latitude' => -19.9167, 'longitude' => -43.9345],
            ['cidade' => 'Porto Alegre', 'estado' => 'RS', 'latitude' => -30.0346, 'longitude' => -51.2177],
            ['cidade' => 'Curitiba', 'estado' => 'PR', 'latitude' => -25.4296, 'longitude' => -49.2712],
            ['cidade' => 'Salvador', 'estado' => 'BA', 'latitude' => -12.9714, 'longitude' => -38.5014],
            ['cidade' => 'Recife', 'estado' => 'PE', 'latitude' => -8.0476, 'longitude' => -34.8770],
            ['cidade' => 'Fortaleza', 'estado' => 'CE', 'latitude' => -3.7319, 'longitude' => -38.5267],
            ['cidade' => 'Brasília', 'estado' => 'DF', 'latitude' => -15.7942, 'longitude' => -47.8822],
            ['cidade' => 'Manaus', 'estado' => 'AM', 'latitude' => -3.1190, 'longitude' => -60.0217],
        ];

        $veiculos = [
            ['marca' => 'Volkswagen', 'modelos' => ['Gol', 'Polo', 'Virtus', 'T-Cross', 'Nivus']],
            ['marca' => 'Fiat', 'modelos' => ['Uno', 'Argo', 'Mobi', 'Cronos', 'Toro']],
            ['marca' => 'Chevrolet', 'modelos' => ['Onix', 'Prisma', 'Cruze', 'Tracker', 'S10']],
            ['marca' => 'Hyundai', 'modelos' => ['HB20', 'Creta', 'Tucson', 'Santa Fe']],
            ['marca' => 'Toyota', 'modelos' => ['Corolla', 'Etios', 'Hilux', 'SW4']],
            ['marca' => 'Ford', 'modelos' => ['Ka', 'EcoSport', 'Ranger', 'Mustang']],
            ['marca' => 'Renault', 'modelos' => ['Kwid', 'Sandero', 'Logan', 'Duster']],
            ['marca' => 'Honda', 'modelos' => ['Fit', 'Civic', 'HR-V', 'CR-V']],
        ];

        $combustiveis = ['Gasolina', 'Álcool', 'Flex', 'Diesel', 'Híbrido', 'Elétrico'];
        $cores = ['Branco', 'Preto', 'Prata', 'Vermelho', 'Azul', 'Cinza', 'Verde', 'Amarelo'];
        $situacoes = ['Novo', 'Seminovo', 'Usado'];

        for ($i = 0; $i < 50; $i++) {
            $cidade = $faker->randomElement($cidades);
            $veiculo = $faker->randomElement($veiculos);
            $modelo = $faker->randomElement($veiculo['modelos']);

            $anoFabricacao = $faker->numberBetween(2010, 2023);
            $anoModelo = $anoFabricacao + $faker->numberBetween(0, 1);

            $quilometragem = $faker->numberBetween(0, 200000);
            $preco = $this->gerarPreco($modelo, $anoFabricacao, $quilometragem);

            Anuncio::create([
                'marca' => $veiculo['marca'],
                'modelo' => $modelo,
                'ano_modelo' => $anoModelo,
                'ano_fabricacao' => $anoFabricacao,
                'cor' => $faker->randomElement($cores),
                'combustivel' => $faker->randomElement($combustiveis),
                'portas' => $faker->numberBetween(2, 4),
                'placa' => $faker->regexify('[A-Z]{3}[0-9][A-Z][0-9]{2}'),
                'situacao' => $faker->randomElement($situacoes),
                'localizacao' => $cidade['cidade'] . ', ' . $cidade['estado'],
                'descricao' => $faker->sentence(10),
                'detalhes' => $faker->paragraph(3),
                'quilometragem' => $quilometragem,
                'preco' => $preco,
                'latitude' => $cidade['latitude'] + $faker->randomFloat(7, -0.1, 0.1),
                'longitude' => $cidade['longitude'] + $faker->randomFloat(7, -0.1, 0.1),
                'cidade' => $cidade['cidade'],
                'estado' => $cidade['estado'],
                'status' => $faker->randomElement(['ativo', 'inativo']),
            ]);
        }
    }

    private function gerarPreco($modelo, $ano, $km)
    {
        $precoBase = 10000 + (($ano - 2010) * 5000);
        $reducaoKm = min($km * 0.1, 30000);
        $ajuste = rand(-2000, 5000);

        $preco = $precoBase - $reducaoKm + $ajuste;

        return max($preco, 5000);

    }
}
