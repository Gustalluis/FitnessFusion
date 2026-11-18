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
        Schema::create('planos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50)->unique();
            $table->decimal('valor', 10, 2);
            $table->unsignedSmallInteger('duracao_meses');
            $table->text('descricao')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE planos ADD CONSTRAINT planos_valor_positivo CHECK (valor >= 0)');
        DB::statement('ALTER TABLE planos ADD CONSTRAINT planos_duracao_valida CHECK (duracao_meses > 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planos');
    }
};
