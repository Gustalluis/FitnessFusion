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
        Schema::create('inscricoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->restrictedOnDelete();
            $table->foreignId('plano_id')->index()->constrained('planos')->restrictedOnDelete();
            $table->decimal('valor', 10, 2);
            $table->date('data_inicio');
            $table->date('data_termino');
            $table->enum('status', ['ativo', 'vencido', 'cancelado'])->default('ativo');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE inscricoes ADD CONSTRAINT inscricoes_periodo_valido CHECK (data_termino >= data_inicio)");
        DB::statement("ALTER TABLE inscricoes ADD CONSTRAINT inscricoes_valor_positivo CHECK (valor >= 0)");
        DB::statement("CREATE UNIQUE INDEX inscricoes_uma_ativa_por_cliente ON inscricoes (cliente_id) WHERE status = 'ativo'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscricoes');
    }
};
