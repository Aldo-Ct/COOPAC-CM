<?php

namespace Database\Factories;

use App\Models\Simulacion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SimulacionFactory extends Factory
{
    protected $model = Simulacion::class;

    public function definition()
    {
        $estados = ['nuevo', 'contactado', 'en_evaluacion', 'aprobado_preliminar', 'descartado'];
        $tipos = ['consumo', 'hipotecario', 'vehicular'];

        return [
            'nombre' => $this->faker->name(),
            'dni' => $this->faker->numerify('##########'),
            'celular' => $this->faker->numerify('9########'),
            'monto_solicitado' => $this->faker->randomFloat(2, 500, 20000),
            'plazo_meses' => $this->faker->numberBetween(3, 60),
            'tipo_credito' => $this->faker->randomElement($tipos),
            'agencia' => $this->faker->randomElement(['Cabanillas', 'Puno Centro', 'Juliaca']),
            'estado' => $this->faker->randomElement($estados),
            'asesor_id' => User::factory(),
        ];
    }
}
