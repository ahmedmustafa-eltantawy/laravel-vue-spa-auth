<?php

namespace App\Traits\Auth;

use App\Http\Resources\UserResource;

trait AuthHelpers
{

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function userSuccessJsonResonse($user, $status)
    {
        return $this->resposne( [
            'user' => new UserResource($user),
            'token' => $this->userAccessToken( $user ),
            'redirect_to' => $this->redirectTo( $user )
        ] , $status );
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
