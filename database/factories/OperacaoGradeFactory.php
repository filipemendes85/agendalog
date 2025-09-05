<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Operacao;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OperacaoGrade>
 */
class OperacaoGradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'operacao_id' => Operacao::inRandomOrder()->first()->id,
            'peso' => $this->faker->randomFloat(3,10000, 20000),
            'datainicio' => $this->faker->dateTimeBetween('now', '+1 month'),
            'descricao' => $this->faker->sentence(100),
            'status' => 'I',
        ];
    }
}
