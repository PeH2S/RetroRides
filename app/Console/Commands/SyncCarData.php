<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CarsApiService;
use App\Models\Brand; 

class SyncCarData extends Command
{
    protected $signature = 'sync:car-data';
    protected $description = 'Sincroniza marcas e modelos de veículos da API';

    protected $carsApiService;

    public function __construct(CarsApiService $carsApiService)
    {
        parent::__construct();
        $this->carsApiService = $carsApiService;
    }

    public function handle()
    {
        $this->info('Sincronizando marcas...');
        if ($this->carsApiService->fetchAndStoreBrands()) {
            $this->info('Marcas sincronizadas com sucesso.');


            $brands = Brand::all();
            foreach ($brands as $brand) {
                $this->info("Sincronizando modelos para a marca {$brand->name}...");
                $this->carsApiService->fetchAndStoreModelsForBrand($brand->api_id);
            }
        } else {
            $this->error('Erro ao sincronizar marcas.');
        }
    }
}
