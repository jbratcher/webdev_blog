<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $user = new User;
        $user->name = 'Samuel Jackson';
        $user->email = 'samueljackson@jackson.com';
        $user->password = bcrypt('samuel1234');
        $user->save();

        $admin = new User;
        $admin->name = 'Neo Ighodaro';
        $admin->email = 'neo@creativitykills.co';
        $admin->password = bcrypt('neo1234');
        $admin->save();
    }
}
