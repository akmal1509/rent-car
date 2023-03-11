<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Brand;
use App\Models\Car;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Cviebrock\EloquentSluggable\Services\SlugService;


class CarTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_store_data()
    {
        $user = User::factory()->create();
        $brand = Brand::factory()->create();
        $name = $this->faker->words(3, true);

        $response = $this->actingAs($user)
            //Hit post ke method store, fungsinya ya akan lari ke fungsi store.
            // ->from('/admin/cars/')
            ->post('/admin/cars/', [
                //isi parameter sesuai kebutuhan request
                'name' => $name,
                'slug' => SlugService::createSlug(Car::class, 'slug', $name),
                'capacity' => $this->faker->randomDigitNotNull(),
                'price' => $this->faker->randomNumber(9, true),
                'year' => $this->faker->randomNumber(4, true),
                'image' => $this->faker->image(),
                'userId' => $user->id,
                // 'brandId' => $brand->id,
            ]);

        $response->assertStatus(302);
        $errors = session('errors');
        $response->assertTrue(true);
        $response->assertRedirect('/admin/cars');
    }
}
