<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\Auth\AuthHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Traits\Api\ApiResponseGenrator;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    use ApiResponseGenrator, AuthHelpers;

    public function register(RegisterRequest $request)
    {
        event(new Registered($user = $this->create($request->validated())));

        $this->guard()->login($user);

        return $this->userSuccessJsonResonse($user, 201 );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

}
