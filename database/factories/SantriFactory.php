<?php

namespace Database\Factories;

use App\Models\Santri;
use App\Models\User;
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
            'id'                     => Str::uuid(),
            // 'santri_number'                 => $this->faker->date('Y').'.'.$this->faker->unique()->numberBetween(00001, 99999),
            'name'                   => $this->faker->unique()->name('male'),
            'address'                => $this->faker->unique()->address,
            'birth_date'             => now(),
            'birth_place'            => $this->faker->unique()->city,
            'phone'                  => $this->faker->unique()->phoneNumber,
            'school_old'             => 'SMPN '.$this->faker->randomDigitNotNull.' '.$this->faker->unique()->city,
            'school_address_old'     => $this->faker->unique()->address,
            'school_current'         => 'SMAN '.$this->faker->randomDigitNotNull.' '.$this->faker->unique()->city,
            'school_address_current' => $this->faker->unique()->address,
            'father_name'            => $this->faker->unique()->name('male'),
            'mother_name'            => $this->faker->unique()->name('female'),
            'father_job'             => 'Petani',
            'mother_job'             => 'Ibu Rumah Tangga',
            'parent_phone'           => $this->faker->unique()->phoneNumber,
            'entry_year'             => '2017',
            'year_out'               => '2021',
        ];
    }
}
