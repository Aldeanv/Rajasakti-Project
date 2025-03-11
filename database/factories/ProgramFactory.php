<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(4);
        return [    
            'slug' => Str::slug($title),
            'time' => $this->faker->time(),
            'date' => $this->faker->date(),
            'location' => $this->faker->city(),
            'maps' => $this->faker->url(),
            'title' => $title,
            'body' => $this->faker->paragraphs(3, true),
        ];
    }
}
