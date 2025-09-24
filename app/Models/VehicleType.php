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
        'tipoVeiculo',
        'qtdeEixo',
        'pesoLiquido',
        'pesoBruto',
        'comprimento',
        'altura',
        'largura',
        'ativo',
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'qtdeEixo' => 'integer',
        'pesoLiquido' => 'decimal:2',
        'pesoBruto' => 'decimal:2',
        'comprimento' => 'decimal:2',
        'altura' => 'decimal:2',
        'largura' => 'decimal:2',
    ];

    /**
     * The attributes that should have default values.
     *
     * @var array
     */
    protected $attributes = [
        'qtdeEixo' => 0,
        'pesoLiquido' => 0.00,
        'pesoBruto' => 0.00,
        'ativo' => true,
    ];
}