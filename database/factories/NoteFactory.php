<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'send_date' => $this->faker->date,
            'is_published' => $this->faker->boolean,
            'heart_count' => $this->faker->numberBetween(0, 50),
            'recipient' => $this->faker->email, // Tambahkan baris ini
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
