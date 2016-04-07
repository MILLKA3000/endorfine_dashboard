<?php

use Illuminate\Database\Seeder;

class typeVariables extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\TypeVariablesOfPayment::create([
            'name' => 'percent',
        ]);

        \App\TypeVariablesOfPayment::create([
            'name' => 'static',
        ]);

        \App\TypeVariablesOfPayment::create([
            'name' => 'array',
        ]);
    }
}
