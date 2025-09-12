<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;
    protected $table = 'transportadora';
    protected $fillable = [
        'id',
        'nome',
        'tipoPessoa',
        'documento',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'estado',
        'cep',
        'email',
        'telefone',
        'ativo',
        'maxtradeId'
    ];

    public $sortable = [
        'nome',
        'email',
        'telefone',
        'ativo',
        'created_at'
    ];
}
