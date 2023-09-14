<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Estate>
 */
class EstateFactory extends Factory
{
    /** deprecated ?
     * protected $model = Estate:class
     */

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = 'The ' . $this->faker->firstName();
        $price = random_int(100000, 1000000);
        $bedrooms = random_int(1, 5);
        $bathrooms = random_int(1, 5);
        $storeys = random_int(1, 5);
        $garages = random_int(1, 5);

        $data = json_encode([
            'name' => $name,
            'price' => $price,
            'bedrooms' => $bedrooms,
            'bathrooms' => $bathrooms,
            'storeys' => $storeys,
            'garages' => $garages,
        ]);

        return [
            'name' => $name,
            'price' => $price,
            'bedrooms' => $bedrooms,
            'bathrooms' => $bathrooms,
            'storeys' => $storeys,
            'garages' => $garages,
            'data' => $data,
        ];
    }
}
