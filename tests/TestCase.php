<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($role = 'Administrator', $user = null)
    {
        $user = $user ?: \App\Models\User::factory(['role' => $role])->create();

        $this->actingAs($user);

        return $user;
    }
}
