<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::whereNull( 'role_id' )->get();
        $users->map( function( $user, $key ){
            $role = Role::pluck('id')->random(1)->first();
            $user->update([
                'role_id' => $role
            ]);
        });

    }
}
