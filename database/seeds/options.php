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
            'name' => 'Назва сайту',
            'description' => 'Введіть назву клубу',
            'value' => '',
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
            'key' => 'footer',
            'name' => 'Інфа',
            'description' => 'Вкл.-викл. футера',
            'value' => '',
            'tag' => 'options-switch'
        ]);
        \App\Options::create([
            'key' => 'themes',
            'name' => 'Кольорова тема',
            'description' => 'Вибір кольорової схеми',
            'value' => '',
            'tag' => 'options-select',
            'options' => '{[\'id\':1, \'name\':\'skin-red\'], [\'id\':2, \'name\':\'skin-red-light\']}'
        ]);
    }
}