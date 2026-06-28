<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            // Adiciona coluna de categoria (nullable = produto pode não ter categoria)
            $table->foreignId('categoria_id')->nullable()->after('estoque')->constrained('categorias')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
        });
    }
};