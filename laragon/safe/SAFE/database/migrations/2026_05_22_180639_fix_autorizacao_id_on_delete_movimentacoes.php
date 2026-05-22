<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('movimentacoes', function (Blueprint $table) {
            // Remove a FK atual (sem ON DELETE definido = RESTRICT)
            $table->dropForeign(['autorizacao_id']);

            // Recria a FK com ON DELETE SET NULL
            $table->foreign('autorizacao_id')
                  ->references('id')
                  ->on('autorizacoes')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('movimentacoes', function (Blueprint $table) {
            $table->dropForeign(['autorizacao_id']);

            $table->foreign('autorizacao_id')
                  ->references('id')
                  ->on('autorizacoes');
        });
    }
};
