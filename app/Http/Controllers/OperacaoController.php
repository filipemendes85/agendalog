<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operacao;

class OperacaoController extends Controller
{
    public function index() {

        $operacao = Operacao::all();
        return dd($operacao);
    } 

    public function show($id = 0) {
        return "Operação: ".$id;
    }
}
