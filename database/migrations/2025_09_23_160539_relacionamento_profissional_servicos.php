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
        // Remove a coluna `especialidade` de profissionais, se existir
        Schema::table('profissionais', function (Blueprint $table) {
            if (Schema::hasColumn('profissionais', 'especialidade')) {
                $table->dropColumn('especialidade');
            }
        });

        // Cria a tabela associativa profissional_servico
        Schema::create('profissional_servico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profissional_id')->constrained('profissionais')->onDelete('cascade');
            $table->foreignId('servico_id')->constrained('servicos')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['profissional_id', 'servico_id']); // evita duplicação
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // drop da tabela associativa
        Schema::dropIfExists('profissional_servico');

        // recria a coluna especialidade em profissionais
        Schema::table('profissionais', function (Blueprint $table) {
            $table->string('especialidade')->nullable();
        });
    }
};