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
        \App\Models\Santri::factory()->create();
        \App\Models\User::factory()->create();
        \App\Models\Cost::factory()->create();
        // \App\Models\CashBook::factory(10)->create();
        // \App\Models\InMail::factory(1)->create();
        // \App\Models\OutMail::factory(1)->create();
    }
}
