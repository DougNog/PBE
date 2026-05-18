<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained();
            $table->foreignId('autorizacao_id')->nullable()->constrained('autorizacoes');
            $table->foreignId('registrado_por')->constrained('users');
            $table->enum('tipo', ['entrada', 'saida']);
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimentacoes');
    }
};
