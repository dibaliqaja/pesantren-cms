<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id'        => $this->faker->uuid(),
            'email'     => $this->faker->email(),
            'password'  => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'      => $this->faker->randomElement(['Administrator', 'Pengurus', 'Santri']),
            'santri_id' => \App\Models\Santri::factory()->create()->id
        ];
    }
}
