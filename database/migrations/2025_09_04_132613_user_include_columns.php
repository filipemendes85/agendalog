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
        Schema::table('users', function (Blueprint $table) {
                $table->boolean('active')->default(true);
                $table->unsignedBigInteger('transportadora_id')->nullable()->unsigned();
                $table->foreign('transportadora_id')->references('id')->on('transportadora');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('active');
                $table->dropForeign('users_transportadora_id_foreign');
                $table->dropColumn('transportadora_id');
            });
    }
};
