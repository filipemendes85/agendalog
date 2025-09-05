<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransportadoraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->unique()->name,
            'tipoPessoa' => 'J',
            'documento' => '01'.$this->faker->unique->randomNumber(6).'0001'.$this->faker->randomNumber(2), //01888792000107
            'endereco' => $this->faker->address,
            'numero' => 's/n',
            'bairro' => 'Centro',
            'cidade' => $this->faker->city,
            'estado' => 'ES',
            'cep' => '29'.$this->faker->unique->randomNumber(6),
            'telefone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique->email,
            'ativo' => true
        ];
    }
}
