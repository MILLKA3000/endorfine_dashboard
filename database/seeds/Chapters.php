<?php

use Illuminate\Database\Seeder;

class Chapters extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Chapter::create([
            'name' => 'Головне відділення',
            'address' => 'Мазепи 26\1',
            'info' => 'Фітнес',
            'email' => 'endorfinefitness@gmail.com'
        ]);

        \App\Chapter::create([
            'name' => 'Відділення 2',
            'address' => 'Центр',
            'info' => 'Тренажерний зал',
            'email' => 's.tchekanov@svitla.com'
        ]);
    }
}
