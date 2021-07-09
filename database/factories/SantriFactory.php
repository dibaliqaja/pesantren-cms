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
            'id'                     => 'fa201ed9-6016-4d90-b3aa-f4858c5260d6',
            'name'                   => 'Muhammad Iqbal',
            'address'                => 'Jalan Raya Rengel No. 155, Des. Rengel, Kec. Rengel, Kab. Tuban',
            'birth_date'             => '1991-07-09',
            'birth_place'            => 'Tuban',
            'phone'                  => '089684353004',
            'school_old'             => 'SMPN 1 Rengel',
            'school_address_old'     => 'Jl. Sawahan No.46, Dusun Purboyo Mayang, Rengel, Tuban',
            'school_current'         => 'SMKN 1 Tuban',
            'school_address_current' => 'Jl. Mastrip No.2, Sidorejo, Kec. Tuban, Kabupaten Tuban',
            'father_name'            => 'Bagung Prasojo',
            'mother_name'            => 'Siti Fatimah',
            'father_job'             => 'Wiraswasta',
            'mother_job'             => 'Ibu Rumah Tangga',
            'parent_phone'           => $this->faker->unique()->phoneNumber,
            'entry_year'             => '2017',
            'year_out'               => '2021',
        ];

        // return [
        //     'id'                     => Str::uuid(),
        //     'name'                   => $this->faker->unique()->name('male'),
        //     'address'                => $this->faker->unique()->address,
        //     'birth_date'             => now(),
        //     'birth_place'            => $this->faker->unique()->city,
        //     'phone'                  => $this->faker->unique()->phoneNumber,
        //     'school_old'             => 'SMPN '.$this->faker->randomDigitNotNull.' '.$this->faker->unique()->city,
        //     'school_address_old'     => $this->faker->unique()->address,
        //     'school_current'         => 'SMAN '.$this->faker->randomDigitNotNull.' '.$this->faker->unique()->city,
        //     'school_address_current' => $this->faker->unique()->address,
        //     'father_name'            => $this->faker->unique()->name('male'),
        //     'mother_name'            => $this->faker->unique()->name('female'),
        //     'father_job'             => 'Petani',
        //     'mother_job'             => 'Ibu Rumah Tangga',
        //     'parent_phone'           => $this->faker->unique()->phoneNumber,
        //     'entry_year'             => '2017',
        //     'year_out'               => '2021',
        // ];
    }
}
