<?php

namespace Database\Factories;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role' => Role::Aluno,
            'ativo' => true,
            'anonimizado_em' => null,
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'cpf' => fake()->unique()->cpf(false),
            'data_nascimento' => fake()->dateTimeBetween('-65 years', '-18 years')->format('Y-m-d'),
            'telefone' => fake()->numerify('119########'),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => Role::Admin,
        ]);
    }

    public function funcionario(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => Role::Funcionario,
        ]);
    }

    public function inativo(): static
    {
        return $this->state(fn (array $attributes) => [
            'ativo' => false,
        ]);
    }

    public function anonimizado(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Titular Anonimizado',
            'email' => 'anonimo-'.fake()->unique()->numberBetween(1000, 999999).'@anonimizado.invalid',
            'cpf' => null,
            'data_nascimento' => null,
            'telefone' => null,
            'ativo' => false,
            'anonimizado_em' => now(),
        ]);
    }
}
