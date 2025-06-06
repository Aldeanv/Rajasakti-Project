<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
    public function definition(): array
    {
        $t=fake()->sentence();
        return [
            'slug' => Str::slug($t),
            'img' => '/img/berita1.jpg',
            'title' => $t,
            'body' => fake()->paragraph(120),
        ];
    }
}
