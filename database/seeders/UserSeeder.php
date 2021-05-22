<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Models\User;
        $admin->nama= "dina p";
        $admin->username= "dinap";
        $admin->email= "dinap@gmail.com";
        $admin->password= \Hash::make("dinap");
        $admin->roles = 0;
        $admin->save();

        $user = new \App\Models\User;
        $user->nama= "dina pus";
        $user->username= "dinapus";
        $user->email= "dinapus@gmail.com";
        $user->password= \Hash::make("dinap");
        $user->roles = 1;
        $user->save();
    }
}
