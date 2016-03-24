<?php

use Illuminate\Database\Seeder;

class traning_details extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\TraningDetails::create([
            'name' => 'Фітнес-мікс',
            'detail' => 'Фітнес-мікс'
        ]);
        \App\TraningDetails::create([
            'name' => 'Пілатес',
            'detail' => 'Пілатес'
        ]);
    }
}
