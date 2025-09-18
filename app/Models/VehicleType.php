<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class VehicleType extends Model
{
    use HasFactory;

    protected $table = 'tipo_veiculo';

    protected $fillable = [
        'nomeVeiculo',
        'qtdeEixo',
        'pesoSuportado',
        'comprimentoMedio',
        'altura',
        'largura',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'integer',
        'pesoSuportado' => 'decimal:2',
        'comprimentoMedio' => 'decimal:2',
        'altura' => 'decimal:2',
        'largura' => 'decimal:2',
    ];
}
