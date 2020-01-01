<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $user = new User;
        $user->name = 'Jeremy Bratcher';
        $user->email = 'jeremybratcher@gmail.com';
        $user->image_src = '/images/profile.jpg';
        $user->password = bcrypt('Placeholder');
        $user->intro = 'About Me';
        $user->bio = 'Tech enthusiast with a strong eye for visual design and a knack for problem solving. Interested in UI/UX and SPA/PWAs.';
        $user->save();
    }
}
