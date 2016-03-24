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
            'detail' => 'Фітнес-мікс',
            'color' => '#39ea1e'
        ]);
        \App\TraningDetails::create([
            'name' => 'Пілатес',
            'detail' => 'Пілатес',
            'color' => '#72a0e5'
        ]);

        \App\TraningDetails::create([
            'name' => 'Табата',
            'detail' => 'Табата',
            'color' => '#d272e5'
        ]);
    }
}
