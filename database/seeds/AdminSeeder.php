<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->name = "admin";
        $user->email = "admin@custom.com";
        $user->username = "admin";
        $user->password = bcrypt('secret');
        $user->role_id = \App\Common\Roles::ROLE_ADMIN;
        $user->status = \App\User::ACTIVATE;
        $user->save();
    }
}
