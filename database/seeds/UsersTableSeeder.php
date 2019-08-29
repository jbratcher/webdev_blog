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
        $user->name = 'Jeremy Bratcher';
        $user->email = 'jeremybratcher@gmail.com';
        $user->password = bcrypt('Placeholder');
        $user->save();
    }
}
