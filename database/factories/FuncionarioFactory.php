<?php

namespace Database\Factories;

use App\Models\Funcionario;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Funcionario>
 */
class FuncionarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->funcionario(),
            'cargo' => fake()->randomElement(['Instrutor', 'Recepcionista', 'Personal Trainer', 'Gerente']),
            'salario' => fake()->randomFloat(2, 1000, 10000),
            'data_admissao' => fake()->dateTimeBetween('-10 years', 'now'),
        ];
    }
}
