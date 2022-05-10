<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\Santri::factory()->create();
        // \App\Models\User::factory()->create();
        $this->call(SantrisTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CostsTableSeeder::class);
        \App\Models\InMail::factory()->create();
        \App\Models\OutMail::factory()->create();
    }
}
