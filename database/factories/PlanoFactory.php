<?php

namespace Database\Factories;

use App\Models\Plano;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Plano>
 */
class PlanoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->unique()->words(2, true),
            'descricao' => fake()->sentence(),
            'duracao_meses' => fake()->randomElement([1, 3, 6, 12]),
            'valor' => fake()->randomFloat(2, 50, 500),
            'ativo' => true,
        ];
    }

    public function inativo(): static
    {
        return $this->state(fn (array $attributes) => [
            'ativo' => false,
        ]);
    }
}
