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
            $table->string('nomeVeiculo', 100)
                  ->comment('Nome do veículo (Carreta, Truck, Bitrem, Rodotrem)');
            
            $table->string('tipoVeiculo', 100)
                  ->nullable()
                  ->comment('Tipo de veículo (toco, graneleiro, caçamba)');
            
            $table->unsignedInteger('qtdeEixo')
                  ->nullable()
                  ->comment('Quantidade de eixos do veículo');

            $table->decimal('pesoLiquido', 8, 2)
                  ->default(0.00)
                  ->comment('Peso líquido suportado pelo veículo');

            $table->decimal('pesoBruto', 8, 2)
                  ->default(0.00)
                  ->comment('Peso bruto do veículo');

            $table->decimal('comprimento', 5, 2)
                  ->nullable()
                  ->comment('Comprimento em metros');

            $table->decimal('altura', 5, 2)
                  ->nullable()
                  ->comment('Altura em metros');

            $table->decimal('largura', 5, 2)
                  ->nullable()
                  ->comment('Largura em metros');

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
