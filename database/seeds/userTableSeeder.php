<?php

use Illuminate\Database\Seeder;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'=> 'admin',
            'email'=>'dennysugianto1@gmail.com',
            'password'=> bcrypt('admin')
        ]);
    }
}
