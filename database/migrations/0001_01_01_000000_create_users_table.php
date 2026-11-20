<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 150);
            $table->char('cpf', 11)->nullable()->unique();
            $table->date('data_nascimento')->nullable();
            $table->string('telefone', 11)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'funcionario', 'aluno'])->default('aluno');
            $table->boolean('ativo')->default(true);
            $table->timestamp('anonimizado_em')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement('CREATE UNIQUE INDEX users_email_unico ON users (lower(email))');
        DB::statement("ALTER TABLE users ADD CONSTRAINT users_cpf_numerico CHECK (cpf IS NULL OR cpf ~ '^[0-9]{11}$')");
        DB::statement("ALTER TABLE users ADD CONSTRAINT users_telefone_valido CHECK (telefone IS NULL OR telefone ~ '^[0-9]{10,11}$')");
        DB::statement('ALTER TABLE users ADD CONSTRAINT users_dados_civis_obrigatorios CHECK (anonimizado_em IS NOT NULL OR (cpf IS NOT NULL AND data_nascimento IS NOT NULL))');
        DB::statement('ALTER TABLE users ADD CONSTRAINT users_anonimizado_inativo CHECK (anonimizado_em IS NULL OR ativo = false)');

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
