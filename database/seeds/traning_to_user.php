<?php

use Illuminate\Database\Seeder;

class traning_to_user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\TraningToTrainer::create([
            'id_training' => 1,
            'id_user' => 1,
            'detail' => 'Займаємося на паперовий тарілках. Завдяки ковзанню пропрацьовуються глибокі мязи тіла, чудово підтягуються мязи живота.Одяг легкий, взуті у кросівках.',
        ]);

        \App\TraningToTrainer::create([
            'id_training' => 1,
            'id_user' => 1,
            'detail' => 'Заняття спрямоване на покращення постави, зняття спазмів зі спини, укріплення м\'язів черевного пресу, розвиток сили і гнучкості. Одяг зручний і легкий. Займаємося босими.',
        ]);
    }
}
