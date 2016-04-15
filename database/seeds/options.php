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
            'tag' => 'options-input',
            'group' => '0',
            'columns' => '4',
            'defaultValue' => 'Club name'
        ]);
        \App\Options::create([
            'key' => 'logo',
            'name' => 'Ваше лого',
            'description' => 'Завантажте ваше лого',
            'tag' => 'options-uploader',
            'group' => '0',
            'columns' => '4',
            'defaultValue' => ''
        ]);
        \App\Options::create([
            'key' => 'logo_switcher',
            'name' => 'Включення логл',
            'description' => 'лого або текст',
            'tag' => 'options-switch',
            'group' => '0',
            'columns' => '4',
            'defaultValue' => 'off'
        ]);
        \App\Options::create([
            'key' => 'themes',
            'name' => 'Кольорова тема',
            'description' => 'Вибір кольорової схеми',
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
            'group' => '1',
            'columns' => '3',
            'defaultValue' => 'skin-green'
        ]);
        \App\Options::create([
            'key' => 'footer',
            'name' => 'Інфа',
            'description' => 'Вкл.-викл. футера',
            'tag' => 'options-switch',
            'group' => '1',
            'columns' => '3',
            'defaultValue' => 'on'
        ]);
        \App\Options::create([
            'key' => 'next_birthdays',
            'name' => 'Наступні ДН',
            'description' => 'Кількість днів для наступних ДН',
            'tag' => 'options-input',
            'group' => '1',
            'columns' => '3',
            'defaultValue' => '3'
        ]);
        \App\Options::create([
            'key' => 'outstanding_tickets',
            'name' => 'Абонементи що скоро закінчуються',
            'description' => 'Днів до закінчення абонементів',
            'tag' => 'options-input',
            'group' => '1',
            'columns' => '3',
            'defaultValue' => '7'
        ]);
    }
}