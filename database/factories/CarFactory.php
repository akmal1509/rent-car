<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use Cviebrock\EloquentSluggable\Services\SlugService;
// use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory

{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->words(3, true);
        return [
            'name' => $name,
            'slug' => SlugService::createSlug(Car::class, 'slug', $name),
            'capacity' => $this->faker->randomDigitNotNull(),
            'price' => $this->faker->randomNumber(9, true),
            'year' => $this->faker->randomNumber(4, true),
            'image' => $this->faker->image()
        ];
    }
}
