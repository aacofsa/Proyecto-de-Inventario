<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Producto;

class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [            
            'id_categoria' => $this->faker->numberBetween(1,50),
            'nombre' => $this->faker->sentence(2),
            'descripcion' => $this->faker->sentence(20),
            'dimensiones' => $this->faker->word(),
            'stock' => $this->faker->numberBetween(1,50),
            'peso' => $this->faker->numberBetween(1,70),
            'foto' => $this->faker->url(),
            'precio'=> $this->faker->numberBetween(1000, 100000),
        ];
    }

    protected $model = Producto::class;
}