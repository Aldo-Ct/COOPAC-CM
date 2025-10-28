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
        Schema::create('simulaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('dni')->nullable();
            $table->string('celular')->nullable();
            $table->decimal('monto_solicitado', 12, 2)->nullable();
            $table->integer('plazo_meses')->nullable();
            $table->string('tipo_credito')->nullable();
            $table->string('agencia')->nullable();
            $table->string('estado')->default('nuevo')->index(); // nuevo, contactado, en_evaluacion, aprobado_preliminar, descartado
            $table->foreignId('asesor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simulaciones');
    }
};
