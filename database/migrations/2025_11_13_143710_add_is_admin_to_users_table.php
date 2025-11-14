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
        // Pega a tabela 'users' que já existe
        Schema::table('users', function (Blueprint $table) {
            // Adiciona a nossa coluna nova
            // 'default(false)' significa que todos os utilizadores novos serão 'não-admin'
            // 'after('email')' é só para organizar no banco
            $table->boolean('is_admin')->default(false)->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Se precisarmos de reverter, este comando apaga a coluna
            $table->dropColumn('is_admin');
        });
    }
};