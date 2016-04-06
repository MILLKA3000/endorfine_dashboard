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
            'tag' => 'options-input'
        ]);
        \App\Options::create([
            'key' => 'logo',
            'name' => 'Ваше лого',
            'description' => 'Завантажте ваше лого',
            'value' => '',
            'tag' => 'options-uploader'
        ]);
        \App\Options::create([
            'key' => 'logo_switcher',
            'name' => 'Включення логл',
            'description' => 'лого або текст',
            'value' => 'off',
            'tag' => 'options-switch'
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
                ]'
        ]);
        \App\Options::create([
            'key' => 'footer',
            'name' => 'Інфа',
            'description' => 'Вкл.-викл. футера',
            'value' => 'on',
            'tag' => 'options-switch'
        ]);
    }
}