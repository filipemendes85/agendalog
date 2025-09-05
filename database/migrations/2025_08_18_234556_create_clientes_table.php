<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 150);
            $table->string('tipoPessoa', 1);
            $table->string('documento', 20);
            $table->string('endereco', 150);
            $table->string('numero', 10)->nullable();
            $table->string('complemento', 150)->nullable();
            $table->string('bairro', 100);
            $table->string('cidade', 100);
            $table->string('estado', 2);
            $table->string('cep', 10)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('telefone', 50)->nullable();
            $table->boolean('ativo')->default(true);
            $table->unsignedBigInteger('maxtradeId')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
