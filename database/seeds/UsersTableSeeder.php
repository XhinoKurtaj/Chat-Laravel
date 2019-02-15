<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'user',
            'last_name' => 'test',
            'email' => 'user@test.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'first_name' => 'user2',
            'last_name' => 'test2',
            'email' => 'user2@test2.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'first_name' => 'john',
            'last_name' => 'doe',
            'email' => 'johndoe@email.com',
            'password' => bcrypt('12345678'),
        ]);

        $faker = Faker\Factory::create();

        factory(User::class, 1000)->create();
    }
}
