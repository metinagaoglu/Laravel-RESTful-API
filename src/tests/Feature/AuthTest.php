<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthTest extends TestCase
{

    private string $registerurl = '/api/auth/register';

    /**
     * Successful register test.
     *
     * @return void
     */
    public function test_successful_register()
    {

        $user = User::factory()->make();

        $response = $this->post($this->registerurl,[
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ]);

        $response->assertStatus(201);
        $response
            ->assertJson(function (AssertableJson $json) {
                return $json->where('success', true)
                    ->has('locale')
                    ->where('message', 'OK')
                    ->where('code', 0)
                    ->has('data');
            });
    }

    /**
     * Password confirmation test
     *
     * @return void
     */
    public function test_password_confirm_on_register()
    {

        $user = User::factory()->make();

        $response = $this->post($this->registerurl,[
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => "doesnotmatchpassword",
        ]);

        $response->assertStatus(400);
        $response
            ->assertJson(function (AssertableJson $json) {
                return $json->where('success', false)
                    ->has('locale')
                    ->has('message')
                    ->where('code', 400)
                    ->has('data');
            });
    }

}
