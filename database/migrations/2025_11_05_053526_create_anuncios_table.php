<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('anuncios', function (Blueprint $t) {
      $t->id();
      $t->string('titulo')->nullable();
      $t->string('imagen');                 // ruta relativa (storage/anuncios/..)
      $t->string('url')->nullable();        // CTA opcional
      $t->boolean('activo')->default(true);
      $t->unsignedInteger('orden')->default(1);
      $t->date('desde')->nullable();
      $t->date('hasta')->nullable();
      $t->timestamps();
      $t->softDeletes();
    });
  }
  public function down(): void { Schema::dropIfExists('anuncios'); }
};
