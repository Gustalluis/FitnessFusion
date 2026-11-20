<?php

namespace Database\Factories;

use App\Enums\StatusInscricao;
use App\Models\Cliente;
use App\Models\Inscricao;
use App\Models\Plano;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Inscricao>
 */
class InscricaoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::factory(),
            'plano_id' => Plano::factory(),
            'data_inicio' => fake()->dateTimeBetween('-20 days', 'now'),
            'valor_contratado' => fn (array $attributes) => Plano::find($attributes['plano_id'])->valor,
            'data_termino' => fn (array $attributes) => Carbon::parse($attributes['data_inicio'])
                ->addMonths(Plano::find($attributes['plano_id'])->duracao_meses),
            'status' => StatusInscricao::Ativa,
        ];
    }

    public function vencida(): static
    {
        return $this->state(fn (array $attributes) => [
            'data_inicio' => fake()->dateTimeBetween('-3 years', '-13 months'),
            'status' => StatusInscricao::Vencida,
        ]);
    }

    public function cancelada(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => StatusInscricao::Cancelada,
        ]);
    }
}
