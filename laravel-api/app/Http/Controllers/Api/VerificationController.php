<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Traits\Auth\AuthHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use App\Providers\RouteServiceProvider;
use App\Traits\Api\ApiResponseGenrator;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerificationController extends Controller
{
    use ApiResponseGenrator, AuthHelpers;

    /**
     * Return True if user  has
     *
     */
    public function hasVerifiedEmail(Request $request)
    {
        return ! $request->user()->hasVerifiedEmail()
                ? $this->resposne([ 'verified' => true ], 200 )
                : $this->resposne([ 'verified' => false ], 406 );
    }

    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {

            return $this->resposne([
                'redirect_to' => RouteServiceProvider::HOME.'?verified=1'
            ], 403 );
        }

        $request->user()->sendEmailVerificationNotification();

        return $this->resposne([], 200 );
    }

     /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markEmailAsVerified(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->resposne( [
                'verified' => true,
                'redirect_to' => RouteServiceProvider::HOME.'?verified=1'
            ] , 403 );
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->resposne( [
            'verified' => true,
            'redirect_to' => RouteServiceProvider::HOME.'?verified=1'
        ] , 200 );
    }

}
