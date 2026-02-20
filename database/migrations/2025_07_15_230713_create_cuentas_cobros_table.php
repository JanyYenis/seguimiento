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
        Schema::create('cuentas_cobros', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamp('fecha');
            $table->unsignedBigInteger('cod_proyecto');
            $table->unsignedBigInteger('cod_remitente');
            $table->string('valor')->nullable();
            $table->string('numero_cuenta');
            $table->string('banco');
            $table->integer('estado')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas_cobros');
    }
};
