<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::truncate();

        $user        = new User;
        $user->name  = 'Joe Doe';
        $user->email = 'joedoe@example.com';
        $user->password = bcrypt('1234');
        $user->save();

        print('Added User Successfully!');

        echo PHP_EOL;


    }

}
