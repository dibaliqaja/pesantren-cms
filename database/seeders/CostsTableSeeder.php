<?php

namespace Database\Seeders;

use App\Models\Cost;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cost = [
            'id' => Str::uuid(),
            'spp' => 0,
            'construction' => 0,
            'facilities'  => 0,
            'wardrobe' => 0,
        ];

        Cost::create($cost);
    }
}
