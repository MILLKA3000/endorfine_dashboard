<?php

use Illuminate\Database\Seeder;

class JoinTrainerToRoom extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\JoinTrainerToRoom::create([
            'name' => '1',
            'room_id' => '4',
            'trainer_id' => '1',
            'room_calendar_id' => 'vne1ldes9kblr7ln0r9b39bf5s@group.calendar.google.com',
            'note' => '...'
        ]);

        \App\JoinTrainerToRoom::create([
            'name' => '1',
            'room_id' => '2',
            'trainer_id' => '2',
            'room_calendar_id' => 'natalya.4ekanova@gmail.com',
            'note' => '...'
        ]);

        \App\JoinTrainerToRoom::create([
            'name' => '1',
            'room_id' => '1',
            'trainer_id' => '3',
            'room_calendar_id' => 'endorfinefitness@gmail.com',
            'note' => '...'
        ]);
    }
}
