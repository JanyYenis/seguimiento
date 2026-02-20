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
        Schema::create('servicios_cuentas_cobros', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cod_cuenta');
            $table->integer('cod_fase');
            $table->integer('cantidad')->default(1);
            $table->string('valor');
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicio_cuenta_cobros');
    }
};
