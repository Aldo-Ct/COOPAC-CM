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
    Schema::create('prospectos_credito', function (Blueprint $table) {
    $table->id();
    $table->string('nombre_completo');
    $table->string('dni', 15);
    $table->string('celular', 20);
    $table->decimal('monto_solicitado', 10, 2);
    $table->integer('plazo_meses');
    $table->string('tipo_credito');
    $table->string('agencia'); // <--- NUEVO CAMPO
    $table->string('estado')->default('nuevo');
    $table->timestamps();
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('prospectos_credito');
}

};
