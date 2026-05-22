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
            if (!Schema::hasColumn('autorizacoes', 'faltas')) {
                $table->unsignedTinyInteger('faltas')->default(0)->after('validade_fim');
            }
            $table->unsignedBigInteger('responsavel_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('autorizacoes', function (Blueprint $table) {
            $table->dropColumn('faltas');
        });
    }
};
