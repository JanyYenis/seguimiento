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
        Schema::create('actas_reuniones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nombre_reunion');
            $table->unsignedBigInteger('cod_cliente');
            $table->timestamp('fecha');
            $table->timestamp('fecha_proxima_reunion')->nullable();
            $table->integer('estado')->default(1);
            $table->text('acuerdos');
            $table->text('conclusion');
            $table->unsignedBigInteger('cod_responsable');
            $table->string('url_firma')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acta_reunions');
    }
};
