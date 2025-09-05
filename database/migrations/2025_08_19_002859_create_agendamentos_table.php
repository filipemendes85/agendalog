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
        Schema::create('agendamento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operacaoGrade_id');
            $table->foreign('operacaoGrade_id')->references('id')->on('operacaoGrade');
            $table->unsignedBigInteger('transportadora_id');
            $table->foreign('transportadora_id')->references('id')->on('transportadora');
            $table->string('motorista', 4);
            $table->string('tipodocumento', 4);
            $table->string('documento', 40);
            $table->string('placa', 10);
            $table->string('reboque1', 10);
            $table->string('reboque2', 10);
            $table->string('reboque3', 10);
            $table->string('ticket', 50);
            $table->string('status', 1); //Agendado, Confirmada, Cancelado.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendamento');
    }
};
