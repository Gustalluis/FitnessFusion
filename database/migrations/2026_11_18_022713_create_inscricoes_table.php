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
        Schema::create('inscricoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->index()->constrained('clientes')->restrictOnDelete();
            $table->foreignId('plano_id')->index()->constrained('planos')->restrictOnDelete();
            $table->decimal('valor_contratado', 10, 2);
            $table->date('data_inicio');
            $table->date('data_termino');
            $table->enum('status', ['ativa', 'vencida', 'cancelada'])->default('ativa');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE inscricoes ADD CONSTRAINT inscricoes_periodo_valido CHECK (data_termino > data_inicio)');
        DB::statement('ALTER TABLE inscricoes ADD CONSTRAINT inscricoes_valor_positivo CHECK (valor_contratado >= 0)');
        DB::statement("CREATE UNIQUE INDEX inscricoes_uma_ativa_por_cliente ON inscricoes (cliente_id) WHERE status = 'ativa'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricoes');
    }
};
