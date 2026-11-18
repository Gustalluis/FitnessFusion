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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->char('cpf', 11)->unique();
            $table->date('data_nascimento');
            $table->string('telefone', 20)->nullable();
            $table->foreignId('user_id')->unique()->constrained()->restrictOnDelete();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE clientes ADD CONSTRAINT clientes_telefone_nao_vazio CHECK (telefone IS NULL OR telefone <> '')");
        DB::statement("ALTER TABLE clientes ADD CONSTRAINT clientes_cpf_numerico CHECK (cpf ~ '^[0-9]{11}$')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
