<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vehicle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vehicle_plate' => $this->faker->unique()->lexify('???') .  $this->faker->unique()->numerify('###'),
            'model' => $this->faker->word().' model',
            'brand' => $this->faker->word(). ' brand',
            'type' => $this->faker->randomElement(['motorcycle', 'car', 'truck'])
        ];
    }
}
