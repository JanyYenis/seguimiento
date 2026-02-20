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
        Schema::create('puntos_orden_dia', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cod_acta');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('cod_responsable')->nullable();
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('punto_orden_dias');
    }
};
