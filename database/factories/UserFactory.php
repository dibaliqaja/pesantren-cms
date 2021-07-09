<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Str::uuid(),
            'email' => 'admin@ponpes.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'role'  => 'Administrator', 
            'santri_id' => 'fa201ed9-6016-4d90-b3aa-f4858c5260d6'
        ];

        // return [
        //     'id' => Str::uuid(),
        //     'email' => $this->faker->unique()->safeEmail,
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'role'  => $this->faker->randomElement(['Administrator', 'Pengurus', 'Santri']),
        //     'santri_id' => 'fa201ed9-6016-4d90-b3aa-f4858c5260d6'
        //     'remember_token' => Str::random(10),
        // ];
    }
}
