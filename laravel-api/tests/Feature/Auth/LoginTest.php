<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    // use RefreshDatabase;

    private $response;

    /**
     * Email is Required in Login Proccess
     *
     * @return void
     */
    public function test_email_is_required()
    {
        $this->OverwriteloginUserData( [ "email" => "" ] )
            ->assertions( 422, [ "email" => "The email field is required." ]);
    }

    /**
     * Password is Required in Login Proccess
     *
     * @return void
     */
    public function test_password_is_required()
    {
       $this->OverwriteloginUserData( [ "password" => "" ] )
            ->assertions( 422, [ "password" => "The password field is required." ]);
    }

    /**
     * Token Exist in personal_access_tokens Table
     *
     * @return void
     */
    public function test_token_exist_in_personal_access_tokens_table()
    {
        $new_user = Sanctum::actingAs(
            User::factory()->create(),
            ['regular-user']
        );

        $new_user_token = $new_user->createToken('regular-user');

        $plain_text_token = $new_user_token->plainTextToken;

        $token = $new_user_token->accessToken->token;

        $this->OverwriteloginUserData( [ "email" => $new_user->email ] );

        $this->assertDatabaseHas('personal_access_tokens', [
            'token' => $token,
        ]);

    }

    private function OverwriteloginUserData( $userData ){

        $data = array_merge( [
            "email" => "email@example.com",
            "password" => "password"
        ] , $userData );

        $this->response = $this->postJson('/api/login', $data);

        return $this;

    }

    private function assertions( $status_code, $error )
    {
        $errors = array_keys( $error );

        $msgs = [
            "message" => "The given data was invalid.",
            "errors" => [
                $errors[0] => [
                    $error[$errors[0]]
                ]
            ]
        ];

        $this->response
            ->assertStatus( $status_code )
            ->assertJson($msgs);
    }
}
