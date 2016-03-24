<?php

use Illuminate\Database\Seeder;

class traning_to_weeks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\TraningToWeek::create([
            'id_training_detail' => 1,
            'numDay' => 1,
            'start_time' => '09:30',
            'end_time' => '10:20',
        ]);

        \App\TraningToWeek::create([
            'id_training_detail' => 2,
            'numDay' => 1,
            'start_time' => '11:00',
            'end_time' => '11:50',
        ]);
    }
}
