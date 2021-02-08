<?php

namespace Database\Factories;

use App\Models\Santri;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SantriFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Santri::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id'                            => Str::uuid(),
            'santri_number'                 => $this->faker->date('Y').'.'.$this->faker->unique()->numberBetween(00001, 99999),
            'santri_name'                   => $this->faker->unique()->name,
            'santri_address'                => $this->faker->unique()->address,
            'santri_birth_date'             => now(),
            'santri_birth_place'            => $this->faker->unique()->city,
            'santri_phone'                  => $this->faker->unique()->phoneNumber,
            'santri_school_old'             => 'SMPN '.$this->faker->randomDigitNotNull.' '.$this->faker->unique()->city,
            'santri_school_address_old'     => $this->faker->unique()->address,
            'santri_school_current'         => 'SMAN '.$this->faker->randomDigitNotNull.' '.$this->faker->unique()->city,
            'santri_school_address_current' => $this->faker->unique()->address,
            'santri_father_name'            => $this->faker->unique()->name,
            'santri_mother_name'            => $this->faker->unique()->name,
            'santri_father_job'             => 'Petani',
            'santri_mother_job'             => 'Ibu Rumah Tangga',
            'santri_parent_phone'           => $this->faker->unique()->phoneNumber,
        ];
    }
}
