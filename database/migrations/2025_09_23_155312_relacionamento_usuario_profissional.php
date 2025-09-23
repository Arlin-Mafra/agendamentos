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
        Schema::table('profissionais', function (Blueprint $table) {
            // cria a coluna se não existir
            if (!Schema::hasColumn('profissionais', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id');
            }

            // adiciona a constraint da chave estrangeira
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profissionais', function (Blueprint $table) {
            if (Schema::hasColumn('profissionais', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};