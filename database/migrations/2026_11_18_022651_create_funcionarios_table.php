<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->restrictOnDelete();
            $table->char('cpf', 11)->unique();
            $table->date('data_nascimento');
            $table->string('telefone', 20)->nullable()->unique();
            $table->string('cargo', 50);
            $table->decimal('salario', 10, 2);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE funcionarios ADD CONSTRAINT funcionarios_telefone_nao_vazio CHECK (telefone IS NULL OR telefone <> '')");
        DB::statement("ALTER TABLE funcionarios ADD CONSTRAINT funcionarios_salario_positivo CHECK (salario >= 0)");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
