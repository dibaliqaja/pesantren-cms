<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => Str::uuid(),
                'email' => 'admin@ponpes.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role'  => 'Administrator', 
                'santri_id' => 'fa201ed9-6016-4d90-b3aa-f4858c5260d6'
            ],
            [
                'id' => Str::uuid(),
                'email' => 'pengurus@ponpes.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role'  => 'Pengurus', 
                'santri_id' => 'fa201ed9-6016-4d90-b3aa-f3858c5260d7'
            ],
            [
                'id' => Str::uuid(),
                'email' => 'santri@ponpes.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role'  => 'Santri', 
                'santri_id' => 'fa201ed9-6016-4d90-b3aa-f4858c5160d8'
            ]
        ];

        foreach($users as $user){
            User::create($user);
        }
    }
}
