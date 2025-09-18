<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleType;

class TipoVeiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            [
                'nomeVeiculo' => 'VUC (Veículo Urbano de Carga)',
                'qtdeEixo' => 2,
                'pesoSuportado' => 3000.00,
                'comprimentoMedio' => 6.30,
                'altura' => 2.80,
                'largura' => 2.20,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Toco',
                'qtdeEixo' => 2,
                'pesoSuportado' => 6500.00,
                'comprimentoMedio' => 8.50,
                'altura' => 3.20,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Truck',
                'qtdeEixo' => 3,
                'pesoSuportado' => 14000.00,
                'comprimentoMedio' => 14.00,
                'altura' => 3.40,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Carreta 2 eixos',
                'qtdeEixo' => 2,
                'pesoSuportado' => 17000.00,
                'comprimentoMedio' => 14.00,
                'altura' => 3.90,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Carreta 3 eixos',
                'qtdeEixo' => 3,
                'pesoSuportado' => 27000.00,
                'comprimentoMedio' => 18.00,
                'altura' => 4.00,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Bitrem 7 eixos',
                'qtdeEixo' => 7,
                'pesoSuportado' => 57000.00,
                'comprimentoMedio' => 19.80,
                'altura' => 4.00,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Rodotrem 9 eixos',
                'qtdeEixo' => 9,
                'pesoSuportado' => 74000.00,
                'comprimentoMedio' => 25.00,
                'altura' => 4.40,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Romeu e Julieta',
                'qtdeEixo' => 5,
                'pesoSuportado' => 45000.00,
                'comprimentoMedio' => 18.15,
                'altura' => 4.20,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Cegonheiro',
                'qtdeEixo' => 9,
                'pesoSuportado' => 25000.00,
                'comprimentoMedio' => 23.00,
                'altura' => 4.40,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Cavalo Mecânico Simples',
                'qtdeEixo' => 2,
                'pesoSuportado' => 6000.00,
                'comprimentoMedio' => 6.50,
                'altura' => 3.20,
                'largura' => 2.50,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Cavalo Mecânico Trucado',
                'qtdeEixo' => 3,
                'pesoSuportado' => 10000.00,
                'comprimentoMedio' => 7.00,
                'altura' => 3.40,
                'largura' => 2.50,
                'ativo' => 1,
            ],
        ];

        foreach ($tipos as $tipo) {
            VehicleType::create($tipo);
        }
    }
}
