<?php

use Illuminate\Database\Seeder;

class Rooms extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Room::create([
            'name' => 'Зал №1',
            'chapter_id' => 1,
            'info' => 'Фітнес зал',
        ]);

        \App\Room::create([
            'name' => 'Зал №2',
            'chapter_id' => 1,
            'info' => 'Крос фіт',
        ]);

        \App\Room::create([
            'name' => 'Зал №1',
            'chapter_id' => 2,
            'info' => 'Кардіо зал',
        ]);

        \App\Room::create([
            'name' => 'Зал №2',
            'chapter_id' => 2,
            'info' => 'Басейн',
        ]);
    }
}
