<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('prospectos_credito', function (Blueprint $table) {
            // Si tu campo "estado" ya existe, lo dejamos y solo agregamos el nuevo:
            if (!Schema::hasColumn('prospectos_credito', 'cuota_estimada')) {
                $table->decimal('cuota_estimada', 12, 2)->nullable()->after('agencia');
            }
        });
    }

    public function down(): void
    {
        Schema::table('prospectos_credito', function (Blueprint $table) {
            $table->dropColumn('cuota_estimada');
        });
    }
};
