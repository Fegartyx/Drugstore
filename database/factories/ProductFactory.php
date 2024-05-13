<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->text(100),
            'price' => $this->faker->numberBetween(1000, 100000),
            'stock' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
            'category_id' => $this->faker->numberBetween(1, 10),
            'image' => $this->faker->imageUrl(640, 480),
            'slug' => $this->faker->slug(3),
            'release_date' => $this->faker->dateTime(),
            'expire_date' => $this->faker->dateTime(),
        ];
    }
}
