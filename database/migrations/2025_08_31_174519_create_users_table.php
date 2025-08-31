<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha_hash');
            $table->foreignId('role_id')->nullable()->constrained('roles');
            $table->foreignId('tenant_id')->nullable()->constrained('tenants');
            $table->enum('status', ['ativo', 'inativo'])->default('ativo');
            $table->timestamp('ultimo_login')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};