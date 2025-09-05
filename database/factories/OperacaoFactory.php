<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cliente;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Operacao>
 */
class OperacaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::inRandomOrder()->first()->id,
            'tipoDocumento' => 'DI',
            'documento' => $this->faker->unique->randomNumber(6),
            'produto' => 'Fertilizante tipo '.$this->faker->text(10),
            'saldo' => $this->faker->randomFloat(3, 1000, 40000), //Numero de decimais = 3, Intervalo de valor 1000 a 40000
            'status' => 'A',
            //
        ];
    }
}
