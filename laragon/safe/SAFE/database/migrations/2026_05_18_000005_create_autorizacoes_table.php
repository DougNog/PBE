<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('autorizacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained();
            $table->foreignId('responsavel_id')->constrained('responsaveis');
            $table->foreignId('aprovado_por')->nullable()->constrained('users');
            $table->enum('tipo', ['saida', 'entrada', 'ambos'])->default('saida');
            $table->enum('status', ['ativa', 'expirada', 'revogada', 'pendente_professor'])->default('ativa');
            $table->string('motivo');
            $table->timestamp('validade_inicio')->nullable();
            $table->timestamp('validade_fim')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('autorizacoes');
    }
};
