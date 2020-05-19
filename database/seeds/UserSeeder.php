<?php

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
        DB::table('users')->insert([
            [
                'id' => 1,
                'user_type' => '0',
                'name' => 'Shubhneet Srivastava',
                'gender' => 'M',
                'email' => 'shubhneet@gmail.com',
                'phonenumber' => '9140216837',
                'password' => '$2y$10$P/E9IsnqOHOsiKqNOyyojOVKKmx2ykLIlfvwrWkua1Uqul4mhDrvi',
                'image' => '',
                'dob' => '1986-07-27',
                'address' => 'Shahjahanpur',
                'state_id' => 1,
                'city_id' => 1,
                'status' => 1,
                'remember_token' => '',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ],
        ]);
    }
}
