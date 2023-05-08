<?php

namespace Tests\Feature\Cms;

use App\Models\CashBook;
use App\Models\InMail;
use App\Models\OutMail;
use App\Models\Santri;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_users_cannot_access_the_home_page()
    {
        $response = $this->get(route('home'));
        $response->assertRedirect(route('login'));
    }

    public function test_user_can_view_dashboard()
    {
        $this->signIn();
        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertViewIs('home');
        $response->assertViewHasAll([
            'santri',
            'users',
            'debit',
            'credit',
            'balance',
            'in_mail',
            'out_mail'
        ]);
    }

    public function test_homepage_shows_correct_data_information()
    {
        // every time a new factory user is created
        // one new santri will be created
        $user     = User::factory()->create();
        $inMail   = InMail::factory()->create();
        $outMail  = OutMail::factory()->create();
        $cashBook = CashBook::factory()->create([
            'debit'  => 100,
            'credit' => 50
        ]);

        $this->signIn('Administrator', $user);

        $response = $this->get(route('home'));
        $response->assertStatus(200)
                 ->assertViewHas('santri', 1)
                 ->assertViewHas('users', 1)
                 ->assertViewHas('in_mail', 1)
                 ->assertViewHas('out_mail', 1)
                 ->assertViewHas('debit', 100)
                 ->assertViewHas('credit', 50)
                 ->assertViewHas('balance', 50);
    }
}
