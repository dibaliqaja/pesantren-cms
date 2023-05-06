<?php

namespace Tests\Feature\Cms;

use Database\Seeders\SantrisTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_login_must_enter_email_and_password()
    {
        $response = $this->post('login');
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email'    => "The email field is required.",
            'password' => "The password field is required.",
        ]);
    }

    public function test_registered_user_can_login()
    {
        $this->seed(SantrisTableSeeder::class);
        $this->seed(UsersTableSeeder::class);

        $response = $this->post(route('login'), [
            'email'    => 'admin@ponpes.com',
            'password' => 'password',
        ]);
        $response->assertRedirect(route('home'));
        $response2 = $this->get(route('home'));
        $response2->assertOk();
        $response2->assertSee('Dashboard');
        $response2->assertSee('Santri');
        $response2->assertSee('Surat Masuk');
        $response2->assertSee('Surat Keluar');
        $response2->assertSee('Pengguna');
        $response2->assertSee('Pemasukan Kas');
        $response2->assertSee('Pengeluaran Kas');
        $response2->assertSee('Saldo Kas');
    }
}
