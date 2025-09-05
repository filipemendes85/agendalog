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
        Schema::create('operacao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('cliente');
            $table->string('tipoDocumento', 10)->nullable();;
            $table->string('documento',30)->nullable();;
            $table->string('produto',200)->nullable();;
            $table->double('saldo',10,3);
            $table->string('status', 1); //Em aberto, Iniciada, Suspensa, Cancelada, Finalizada.
            $table->unsignedBigInteger('maxtradeId')->nullable();           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operacao');
    }
};
