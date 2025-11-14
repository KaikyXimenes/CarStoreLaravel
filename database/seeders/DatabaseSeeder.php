<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Usado para o truncate

// Importar os Models que vamos usar
use App\Models\Brand;
use App\Models\VehicleModel;
use App\Models\Color;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Desativar verificação de chaves estrangeiras para o truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Limpar tabelas para evitar duplicados (na ordem inversa das dependências)
        VehicleImage::truncate();
        Vehicle::truncate();
        Color::truncate();
        VehicleModel::truncate();
        Brand::truncate();
        User::truncate();

        // Reativar verificação de chaves
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Criar Utilizador Admin Padrão
        User::factory()->create(['is_admin' => true,
            'name' => 'Admin User',
            'email' => 'admin@carstore.com',
            'password' => bcrypt('admin'),
        ]);

        // 2. Criar Marcas (Brands)
        $brandFiat = Brand::create(['name' => 'Fiat']);
        $brandFord = Brand::create(['name' => 'Ford']);
        $brandVW = Brand::create(['name' => 'Volkswagen']);
        $brandChevrolet = Brand::create(['name' => 'Chevrolet']);

        // 3. Criar Modelos (VehicleModels) e associar às Marcas
        $modelUno = VehicleModel::create(['brand_id' => $brandFiat->id, 'name' => 'Uno']);
        $modelMobi = VehicleModel::create(['brand_id' => $brandFiat->id, 'name' => 'Mobi']);
        $modelKa = VehicleModel::create(['brand_id' => $brandFord->id, 'name' => 'Ka']);
        $modelMustang = VehicleModel::create(['brand_id' => $brandFord->id, 'name' => 'Mustang']);
        $modelGol = VehicleModel::create(['brand_id' => $brandVW->id, 'name' => 'Gol']);
        $modelNivus = VehicleModel::create(['brand_id' => $brandVW->id, 'name' => 'Nivus']);
        $modelOnix = VehicleModel::create(['brand_id' => $brandChevrolet->id, 'name' => 'Onix']);
        $modelTracker = VehicleModel::create(['brand_id' => $brandChevrolet->id, 'name' => 'Tracker']);

        // 4. Criar Cores (Colors)
        $colorBlack = Color::create(['name' => 'Preto']);
        $colorSilver = Color::create(['name' => 'Prata']);
        $colorWhite = Color::create(['name' => 'Branco']);
        $colorRed = Color::create(['name' => 'Vermelho']);

        // 5. Criar Veículos (Vehicles)
        // Vamos criar alguns veículos manualmente para termos dados bonitos

        // Veículo 1
        $v1 = Vehicle::create([
            'vehicle_model_id' => $modelOnix->id,
            'color_id' => $colorRed->id,
            'year' => 2023,
            'mileage' => 15000,
            'price' => 82000.00,
            'description' => 'Onix 1.0 Turbo Premier, o mais completo da categoria. Único dono, todas as revisões feitas na concessionária. Carro sem detalhes.',
            'main_image_url' => 'https://placehold.co/600x400/E63946/FFF?text=Onix+Vermelho',
        ]);
        // Fotos extras para o Veículo 1
        VehicleImage::create(['vehicle_id' => $v1->id, 'url' => 'https://placehold.co/800x600/E63946/FFF?text=Onix+Interior']);
        VehicleImage::create(['vehicle_id' => $v1->id, 'url' => 'https://placehold.co/800x600/E63946/FFF?text=Onix+Lateral']);
        VehicleImage::create(['vehicle_id' => $v1->id, 'url' => 'https://placehold.co/800x600/E63946/FFF?text=Onix+Traseira']);

        // Veículo 2
        $v2 = Vehicle::create([
            'vehicle_model_id' => $modelMustang->id,
            'color_id' => $colorBlack->id,
            'year' => 2022,
            'mileage' => 8000,
            'price' => 450000.00,
            'description' => 'Mustang GT V8 5.0. O verdadeiro muscle car. Importação oficial, com escape desportivo. Impecável.',
            'main_image_url' => 'https://placehold.co/600x400/000/FFF?text=Mustang+Preto',
        ]);
        // Fotos extras para o Veículo 2
        VehicleImage::create(['vehicle_id' => $v2->id, 'url' => 'https://placehold.co/800x600/000/FFF?text=Mustang+Roda']);
        VehicleImage::create(['vehicle_id' => $v2->id, 'url' => 'https://placehold.co/800x600/000/FFF?text=Mustang+Detalhe']);
        VehicleImage::create(['vehicle_id' => $v2->id, 'url' => 'https://placehold.co/800x600/000/FFF?text=Mustang+Painel']);

        // Veículo 3
        $v3 = Vehicle::create([
            'vehicle_model_id' => $modelNivus->id,
            'color_id' => $colorWhite->id,
            'year' => 2024,
            'mileage' => 0,
            'price' => 135000.00,
            'description' => 'Nivus Highline 0km. Pronta entrega. Teto solar, painel digital e ACC. O SUV coupé que conquistou o Brasil.',
            'main_image_url' => 'https://placehold.co/600x400/FFF/333?text=Nivus+Branco',
        ]);
        // Fotos extras para o Veículo 3
        VehicleImage::create(['vehicle_id' => $v3->id, 'url' => 'https://placehold.co/800x600/FFF/333?text=Nivus+0km']);
        VehicleImage::create(['vehicle_id' => $v3->id, 'url' => 'https://placehold.co/800x600/FFF/333?text=Nivus+Interior']);
        VehicleImage::create(['vehicle_id' => $v3->id, 'url' => 'https://placehold.co/800x600/FFF/333?text=Nivus+Teto+Solar']);
        
        // Vamos criar mais alguns aleatórios
        $models = VehicleModel::pluck('id');
        $colors = Color::pluck('id');
        $descriptions = [
            'Carro em excelente estado, único dono, pneus novos.',
            'Perfeito para o dia a dia, económico e ágil.',
            'Veículo de família, espaçoso, completo com ar e direção.',
            'Pouco rodado, com garantia de fábrica.',
        ];

        // Criar mais 12 veículos aleatórios (totalizando 15)
        for ($i = 0; $i < 12; $i++) {
            $vehicle = Vehicle::create([
                'vehicle_model_id' => $models->random(),
                'color_id' => $colors->random(),
                'year' => rand(2018, 2024),
                'mileage' => rand(0, 80000),
                'price' => rand(45000, 150000),
                'description' => $descriptions[array_rand($descriptions)],
                'main_image_url' => 'https://placehold.co/600x400/'.sprintf('%06x', mt_rand(0, 0xFFFFFF)).'/333?text=Carro+'.($i+1),
            ]);

            // 6. Criar as 3 Fotos Extras (VehicleImages)
            VehicleImage::create([
                'vehicle_id' => $vehicle->id,
                'url' => 'https://placehold.co/800x600/'.sprintf('%06x', mt_rand(0, 0xFFFFFF)).'/FFF?text=Foto+Extra+1'
            ]);
            VehicleImage::create([
                'vehicle_id' => $vehicle->id,
                'url' => 'https://placehold.co/800x600/'.sprintf('%06x', mt_rand(0, 0xFFFFFF)).'/FFF?text=Foto+Extra+2'
            ]);
            VehicleImage::create([
                'vehicle_id' => $vehicle->id,
                'url' => 'https://placehold.co/800x600/'.sprintf('%06x', mt_rand(0, 0xFFFFFF)).'/FFF?text=Foto+Extra+3'
            ]);
        }
    }
}