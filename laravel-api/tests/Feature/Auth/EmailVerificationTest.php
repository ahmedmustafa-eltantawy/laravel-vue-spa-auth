<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public $response;
    public $user;

    public function test_email_verification_sent()
    {
        // $this->withoutExceptionHandling();

        $user = $this->user();

        $this->actingAsWithPostJson($user, route( 'api.verification.email' ) )
            ->asserts(200, ['resposne' => [],'status' => 200,'msg' => 'OK',]);
    }



    public function test_unauthenticated_user_get_401_status_code()
    {

        $user = $this->user(false);

        $this->actingAsWithPostJson($user, route( 'api.verification.email' ) )
            ->asserts(401, ["message" => "Unauthenticated."]);
    }

    public function test_return_true_if_email_has_not_verified()
    {
        $user = $this->user(false);

        $this->actingAsWithPostJson($user, route( 'api.email.has-verify' ) )
            ->asserts(200, ['resposne' => ['verified' => true],'msg' => 'OK',]);

    }

    public function test_return_false_if_email_has_verified()
    {
        $user = $this->user(false);

        $this->actingAsWithPostJson($user, route( 'api.email.has-verify' ) )
            ->asserts(406, ['resposne' => ['verified' => false],'msg' => 'Not Acceptable']);
    }

    public function test_email_can_be_verified()
    {
        $this->withoutExceptionHandling();

        Event::fake();

        $user = $this->user();

        $verificationUrl = URL::temporarySignedRoute(
            'api.email.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAsWithPostJson($user, $verificationUrl);

        Event::assertDispatched(Verified::class);

        $this->assertTrue($user->fresh()->hasVerifiedEmail());

        $this->asserts(200, [ 'resposne' => ['verified' => true],'msg' => 'OK']);
    }


    private function actingAsWithPostJson($user, $route)
    {
        $this->response = $this->actingAs($user)
        ->postJson( $route );

        return $this;
    }

    public function asserts($status_code, $data)
    {
        $this->response->assertStatus($status_code)
        ->assertJson($data);
    }

    private function user($authanticated = true)
    {
        if( !$authanticated ){
            return User::factory()->create([
                'email_verified_at' => now(),
            ]);
        }

        return Sanctum::actingAs(
            User::factory()->create([ 'email_verified_at' => null ]),
            ['regular-user']
        );
    }

}
