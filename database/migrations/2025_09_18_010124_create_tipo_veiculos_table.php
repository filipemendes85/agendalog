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
        Schema::create('tipo_veiculo', function (Blueprint $table) {
            $table->id();
            $table->string('nomeVeiculo', 100)->comment('Nome do veículo (Carreta, Truck, Bitrem, Rodotrem)');
            $table->unsignedInteger('qtdeEixo');
            $table->decimal('pesoSuportado', 8, 2)->comment('Para o abatimento do peso na grade operacional');
            $table->decimal('comprimentoMedio', 5, 2)->comment('Para controle logístico no terminal');
            $table->decimal('altura', 5, 2)->comment('Para controle logístico');
            $table->decimal('largura', 5, 2)->comment('Para controle logístico');
            $table->boolean('ativo')->default(true);
            $table->timestamps(); // cria created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_veiculo');
    }
};
