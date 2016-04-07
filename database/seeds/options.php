<?php

use Illuminate\Database\Seeder;

class options extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Options::create([
            'key' => 'title',
            'name' => 'Назва клубу',
            'description' => 'Введіть назву клубу',
            'value' => 'Endorfine',
            'tag' => 'options-input',
            'group' => '1',
            'columns' => '4'
        ]);
        \App\Options::create([
            'key' => 'logo',
            'name' => 'Ваше лого',
            'description' => 'Завантажте ваше лого',
            'value' => 'off',
            'tag' => 'options-uploader',
            'group' => '1',
            'columns' => '4'
        ]);
        \App\Options::create([
            'key' => 'logo_switcher',
            'name' => 'Включення логл',
            'description' => 'лого або текст',
            'value' => 'off',
            'tag' => 'options-switch',
            'group' => '1',
            'columns' => '4'
        ]);
        \App\Options::create([
            'key' => 'themes',
            'name' => 'Кольорова тема',
            'description' => 'Вибір кольорової схеми',
            'value' => 'skin-green',
            'tag' => 'options-select',
            'options' => '[
                {"name":"skin-black"}, 
                {"name":"skin-black-light"},
                {"name":"skin-blue"},
                {"name":"skin-blue-light"},
                {"name":"skin-green"},
                {"name":"skin-green-light"},
                {"name":"skin-purple"},
                {"name":"skin-purple-light"},
                {"name":"skin-red"},
                {"name":"skin-red-light"},
                {"name":"skin-yellow"},
                {"name":"skin-yellow-light"}
                ]',
            'group' => '2',
            'columns' => '3'
        ]);
        \App\Options::create([
            'key' => 'footer',
            'name' => 'Інфа',
            'description' => 'Вкл.-викл. футера',
            'value' => 'on',
            'tag' => 'options-switch',
            'group' => '2',
            'columns' => '3'
        ]);
        \App\Options::create([
            'key' => 'next_birthdays',
            'name' => 'Наступні ДН',
            'description' => 'Кількість днів для наступних ДН',
            'value' => '3',
            'tag' => 'options-input',
            'group' => '2',
            'columns' => '3'
        ]);
        \App\Options::create([
            'key' => 'outstanding_tickets',
            'name' => 'Абонементи що скоро закінчуються',
            'description' => 'Днів до закінчення абонементів',
            'value' => '7',
            'tag' => 'options-input',
            'group' => '2',
            'columns' => '3'
        ]);
    }
}