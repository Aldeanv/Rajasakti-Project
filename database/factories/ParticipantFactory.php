<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participant>
 */
class ParticipantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'program_slug' => Str::slug($this->faker->sentence(3)),
            'nama' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['pria', 'wanita']),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'nip' => $this->faker->unique()->numerify('19##########'),
            'dinas' => $this->faker->company(),
            'jabatan' => $this->faker->jobTitle(),
            'pemda' => $this->faker->city(),
            'alamat' => $this->faker->address(),
            'telepon' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'bukti_pembayaran' => 'bukti_pembayaran/' . $this->faker->uuid() . '.jpg',
        ];
    }
}
