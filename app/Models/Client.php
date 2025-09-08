<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'cliente';

    protected $fillable = [
        'nome',
        'email', 
        'telefone',
        'ativo'
    ];

    // Adicione estas propriedades para documentação
    public $sortable = [
        'nome',
        'email',
        'telefone',
        'ativo',
        'created_at'
    ];

}
