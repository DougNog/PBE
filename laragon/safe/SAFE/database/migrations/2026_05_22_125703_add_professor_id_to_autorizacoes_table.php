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
        Schema::table('autorizacoes', function (Blueprint $table) {
            $table->foreignId('professor_id')->nullable()->after('aprovado_por')->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('autorizacoes', function (Blueprint $table) {
            $table->dropForeign('autorizacoes_professor_id_foreign');
        });
        Schema::table('autorizacoes', function (Blueprint $table) {
            $table->dropColumn('professor_id');
        });
    }
};
