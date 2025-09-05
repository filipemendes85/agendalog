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
        Schema::create('operacaoGrade', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operacao_id');
            $table->foreign('operacao_id')->references('id')->on('operacao');
            $table->double('peso', 10,3);
            $table->dateTime('dataInicio');
            $table->text('descricao')->nullable();
            $table->string('status', 1); //Em aberto, Iniciada, Suspensa, Cancelada, Finalizada
            $table->unsignedBigInteger('maxtradeId')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operacaoGrade');
    }
};
