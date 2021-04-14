<?php

namespace Tests\Feature\Auth;

trait AuthTestingHelpers
{
    private function overwriteUserData( $userData ){

        $data = array_merge( $this->user_data , $userData );

        $this->response = $this->postJson( $this->route_url , $data);

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
