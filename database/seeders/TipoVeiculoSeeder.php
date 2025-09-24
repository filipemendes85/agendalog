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
                'tipoVeiculo' => 'urbano',
                'qtdeEixo' => 2,
                'pesoLiquido' => 3000.00,
                'pesoBruto' => 8000.00,
                'comprimento' => 6.30,
                'altura' => 2.80,
                'largura' => 2.20,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Toco',
                'tipoVeiculo' => 'carga seca',
                'qtdeEixo' => 2,
                'pesoLiquido' => 6500.00,
                'pesoBruto' => 16000.00,
                'comprimento' => 8.50,
                'altura' => 3.20,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Truck',
                'tipoVeiculo' => 'carga seca',
                'qtdeEixo' => 3,
                'pesoLiquido' => 14000.00,
                'pesoBruto' => 23000.00,
                'comprimento' => 14.00,
                'altura' => 3.40,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Carreta 2 eixos',
                'tipoVeiculo' => 'graneleiro',
                'qtdeEixo' => 2,
                'pesoLiquido' => 17000.00,
                'pesoBruto' => 33000.00,
                'comprimento' => 14.00,
                'altura' => 3.90,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Carreta 3 eixos',
                'tipoVeiculo' => 'graneleiro',
                'qtdeEixo' => 3,
                'pesoLiquido' => 27000.00,
                'pesoBruto' => 41000.00,
                'comprimento' => 18.00,
                'altura' => 4.00,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Bitrem 7 eixos',
                'tipoVeiculo' => 'rodoviário',
                'qtdeEixo' => 7,
                'pesoLiquido' => 57000.00,
                'pesoBruto' => 74000.00,
                'comprimento' => 19.80,
                'altura' => 4.00,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Rodotrem 9 eixos',
                'tipoVeiculo' => 'rodoviário',
                'qtdeEixo' => 9,
                'pesoLiquido' => 74000.00,
                'pesoBruto' => 91000.00,
                'comprimento' => 25.00,
                'altura' => 4.40,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Romeu e Julieta',
                'tipoVeiculo' => 'rodoviário',
                'qtdeEixo' => 5,
                'pesoLiquido' => 45000.00,
                'pesoBruto' => 60000.00,
                'comprimento' => 18.15,
                'altura' => 4.20,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Cegonheiro',
                'tipoVeiculo' => 'cegonha',
                'qtdeEixo' => 9,
                'pesoLiquido' => 25000.00,
                'pesoBruto' => 50000.00,
                'comprimento' => 23.00,
                'altura' => 4.40,
                'largura' => 2.60,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Cavalo Mecânico Simples',
                'tipoVeiculo' => 'cavalo',
                'qtdeEixo' => 2,
                'pesoLiquido' => 6000.00,
                'pesoBruto' => 12000.00,
                'comprimento' => 6.50,
                'altura' => 3.20,
                'largura' => 2.50,
                'ativo' => 1,
            ],
            [
                'nomeVeiculo' => 'Cavalo Mecânico Trucado',
                'tipoVeiculo' => 'cavalo',
                'qtdeEixo' => 3,
                'pesoLiquido' => 10000.00,
                'pesoBruto' => 16000.00,
                'comprimento' => 7.00,
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
