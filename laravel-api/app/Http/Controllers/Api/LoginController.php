<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Laravel\Sanctum\NewAccessToken;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Traits\Api\ApiResponseGenrator;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    use ApiResponseGenrator;

    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $request->authenticate();

        return $this->authenticated($request, $this->guard()->user());
    }


    /**
     * Destroy an authenticated session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Do Whatever after Validation successed
     *
     * for insatnce Redirect user to Dashboard if is admin
     *
     */
    protected function authenticated(Request $request, $user)
    {
         return $this->resposne( [
            'user' => new UserResource($user),
            'token' => $this->userAccessToken( $user ),
            'redirect_to' => $this->redirectTo( $user )
        ] , 200 );

    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    private function guard()
    {
        return Auth::guard();
    }

    private function userAccessToken( $user )
    {
        if( ! is_null( $user->tokens()->first() ) ){
            $user->tokens()->delete();
        }

        return $user->createToken('regular-user')->plainTextToken;
    }

    private function redirectTo( $user )
    {
        return route( 'home' );
    }
}
