<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Santri>
 */
class SantriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id'                     => $this->faker->uuid(),
            'name'                   => $this->faker->unique()->name(),
            'address'                => $this->faker->unique()->address(),
            'birth_date'             => $this->faker->date('Y-m-d'),
            'birth_place'            => $this->faker->unique()->city(),
            'phone'                  => '089682353004',
            'school_old'             => 'SMPN 1 ' . $this->faker->unique()->city(),
            'school_address_old'     => $this->faker->unique()->address(),
            'school_current'         => 'SMKN 1 ' . $this->faker->unique()->city(),
            'school_address_current' => $this->faker->unique()->address(),
            'father_name'            => $this->faker->unique()->name('male'),
            'mother_name'            => $this->faker->unique()->name('female'),
            'father_job'             => $this->faker->unique()->jobTitle(),
            'mother_job'             => $this->faker->unique()->jobTitle(),
            'parent_phone'           => '0837842244004',
            'entry_year'             => $this->faker->unique()->year(),
        ];
    }
}
