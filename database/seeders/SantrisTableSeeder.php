<?php

namespace Database\Seeders;

use App\Models\Santri;
use Illuminate\Database\Seeder;

class SantrisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $santris = [
            [
                'id'                     => 'fa201ed9-6016-4d90-b3aa-f4858c5260d6',
                'name'                   => 'Ahmad Dasiman',
                'address'                => 'Jalan Raya Daendels No. 123, Kel. Kasiman, Kec. Tuban, Kab. Tuban',
                'birth_date'             => '1991-07-09',
                'birth_place'            => 'Tuban',
                'phone'                  => '089684353004',
                'school_old'             => 'SMPN 1 Daendels',
                'school_address_old'     => 'Jl. Dasdes No.46, Dusun Purboyo Mayang, Daendels, Tuban',
                'school_current'         => 'SMKN 1 Daendels',
                'school_address_current' => 'Jl. Mastap No.2, Sidorejo, Kec. Tuban, Kabupaten Tuban',
                'father_name'            => 'Bagung Prasojo',
                'mother_name'            => 'Siti Fatimah',
                'father_job'             => 'Wiraswasta',
                'mother_job'             => 'Ibu Rumah Tangga',
                'parent_phone'           => '0857842253004',
                'entry_year'             => '2017',
                'year_out'               => '2021',
            ],
            [
                'id'                     => 'fa201ed9-6016-4d90-b3aa-f3858c5260d7',
                'name'                   => 'Adi Gumilang',
                'address'                => 'Jalan Raya Pattimura No. 30, Kel. Ronggolmulyo, Kec. Tuban, Kab. Tuban',
                'birth_date'             => '1998-10-02',
                'birth_place'            => 'Tuban',
                'phone'                  => '089684353982',
                'school_old'             => 'SMPN 1 Tuban',
                'school_address_old'     => 'Jl. Panglima Sudirman No.46, Tuban',
                'school_current'         => 'SMKN 1 Daendels',
                'school_address_current' => 'Jl. Mastap No.2, Sidorejo, Kec. Tuban, Kabupaten Tuban',
                'father_name'            => 'Sumarno',
                'mother_name'            => 'Finda Gumilang',
                'father_job'             => 'Pengusaha',
                'mother_job'             => 'Ibu Rumah Tangga',
                'parent_phone'           => '0857842253902',
                'entry_year'             => '2017'
            ],
            [
                'id'                     => 'fa201ed9-6016-4d90-b3aa-f4858c5160d8',
                'name'                   => 'Budi Santoso',
                'address'                => 'Jalan Raya Bojongsewu No. 88, Des. Sewu, Kec. Bojongsewu, Kab. Tegal',
                'birth_date'             => '1995-10-10',
                'birth_place'            => 'Tegal',
                'phone'                  => '089682353004',
                'school_old'             => 'SMPN 1 Bojongsewu',
                'school_address_old'     => 'Jl. Bojongsewu No.46, Bojongsewu, Tegal',
                'school_current'         => 'SMKN 1 Tuban',
                'school_address_current' => 'Jl. Mastrip No.2, Sidorejo, Kec. Tuban, Kabupaten Tuban',
                'father_name'            => 'Saman Tosojo',
                'mother_name'            => 'Sri Minah',
                'father_job'             => 'Pegawai Negeri Sipil',
                'mother_job'             => 'Ibu Rumah Tangga',
                'parent_phone'           => '0837842244004',
                'entry_year'             => '2017'
            ]
        ];

        foreach($santris as $santri){
            Santri::create($santri);
        }
    }
}
