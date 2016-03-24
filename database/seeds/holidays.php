<?php

use Illuminate\Database\Seeder;

class holidays extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Holidays::create([
            'name' => 'TEST Holiday',
            'date' => '01-01'
        ]);
    }
}
