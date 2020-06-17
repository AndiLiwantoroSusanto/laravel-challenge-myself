<?php

use App\User;
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
        User::create([
            'name' => 'User01',
            'email' => 'user@user.com',
            'password' => bcrypt('123'),
        ]);
    }
}
