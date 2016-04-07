<?php

use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'confirmed' => 1,
            'role_id' => 1,
            'api_token' => str_random(60),
            'confirmation_code' => md5(microtime() . env('APP_KEY')),
            'enabled' => true
        ]);

        \App\User::create([
            'name' => 'Наталя Чеканова',
            'email' => 'natalya.4ekanova@gmail.com',
            'password' => bcrypt('admin'),
            'confirmed' => 1,
            'role_id' => 3,
            'api_token' => str_random(60),
            'confirmation_code' => md5(microtime() . env('APP_KEY')),
            'enabled' => true
        ]);

        \App\User::create([
            'name' => 'ТЕСТ ТРЕНЕР',
            'email' => 'endorfinefitness@gmail.com',
            'password' => bcrypt('admin'),
            'confirmed' => 1,
            'role_id' => 3,
            'api_token' => str_random(60),
            'confirmation_code' => md5(microtime() . env('APP_KEY')),
            'enabled' => true
        ]);
    }
}
