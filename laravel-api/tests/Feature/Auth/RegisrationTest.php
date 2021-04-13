<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Tests\Feature\Auth\AuthTestingHelpers;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisrationTest extends TestCase
{
    use AuthTestingHelpers, RefreshDatabase;

    protected $user_data = [
        "name" => "UserFakeName",
        "email" => "UserFakeEmail@example.com",
        "password" => "UserFakePassword",
        "password_confirmation" => "UserFakePassword"
    ];

    protected $route_url = '/api/register';

    /**
     * Email Is Required Error
     *
     * @return void
     */
    public function test_registration_email_is_required()
    {
        // $this->withoutExceptionHandling();

        $this->overwriteUserData( array_merge( $this->user_data, [ "email" => "" ] ) )
            ->assertions( 422, [ "email" => "The email field is required." ]);
    }

    /**
     * Name Is Required Error
     *
     * @return void
     */
    public function test_registration_name_is_required()
    {
        $this->overwriteUserData( array_merge( $this->user_data, [ "name" => "" ] ) )
            ->assertions( 422, [ "name" => "The name field is required." ]);
    }

    /**
     * Password Is Required Error
     *
     * @return void
     */
    public function test_registration_password_is_required()
    {
        $this->overwriteUserData( array_merge( $this->user_data, [ "password" => "" ] ) )
            ->assertions( 422, [ "password" => "The password field is required." ]);
    }

    /**
     * Password Confirmation Is Required Error
     *
     * @return void
     */
    public function test_registration_password_confirmation_is_required()
    {
        $this->overwriteUserData( array_merge( $this->user_data, [ "password_confirmation" => "" ] ) )
            ->assertions( 422, [ "password" => "The password confirmation does not match." ]);
    }

    /**
     * Verification Email is Sent
     *
     * @return void
     */
    public function test_registration_verification_email_is_sent()
    {
        Event::fake();

        $this->response = $this->postJson( route( 'api.register' ) , $this->user_data );

        Event::assertListening(Registered::class, \Illuminate\Auth\Listeners\SendEmailVerificationNotification::class);

        $this->response->assertStatus( 201 );
    }

    /**
     * Welcoming new user Email is Sent
     *
     * @return void
     */
    public function test_registration_welcome_email_is_sent()
    {
        Event::fake();

        $this->response = $this->postJson( route( 'api.register' ) , $this->user_data );

        Event::assertListening(Registered::class, \App\Listeners\WelcomingNewUserListener::class);

        $this->response->assertStatus( 201 );
    }

    /**
     * Redirect User To Dashboard or Home Page...
     * Depends on The User Role(s)
     *
     * @return void
     */
    // public function test_redirect_user_to()
    // {
    //     //
    // }


}
