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
        Schema::create('professor_turma', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('turma');
            $table->unique(['user_id', 'turma']);
        });

        // Migra dados existentes antes de remover a coluna
        DB::table('users')
            ->where('role', 'professor')
            ->whereNotNull('turma')
            ->where('turma', '!=', '')
            ->get()
            ->each(function ($user) {
                DB::table('professor_turma')->insert([
                    'user_id' => $user->id,
                    'turma'   => $user->turma,
                ]);
            });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('turma');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('turma')->nullable()->after('role');
        });

        Schema::dropIfExists('professor_turma');
    }
};
