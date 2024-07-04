<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title"=> $this->faker->realText(40, 2),
            "slug"=> $this->faker->slug(),
            "small_description"=> $this->faker->paragraph(2, true),
            "description"=> $this->faker->paragraph(4, true),
            "thumbnail"=> 'no-image.png',
            "user_id"=> rand(1, 10),
            "category_id"=> rand(1,7),
        ];
    }
}
