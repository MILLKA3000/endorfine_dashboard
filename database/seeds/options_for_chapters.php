<?php

use Illuminate\Database\Seeder;

class options_for_chapters extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\OptionsForChapters::create([
            'id_options' => '1',
            'id_chapter' => '1',
            'value' => 'Endorfine',
            'array_permissions' => '1',
        ]);
        \App\OptionsForChapters::create([
            'id_options' => '2',
            'id_chapter' => '1',
            'value' => 'off',
            'array_permissions' => '1',
        ]);
        \App\OptionsForChapters::create([
            'id_options' => '3',
            'id_chapter' => '1',
            'value' => 'off',
            'array_permissions' => '1',
        ]);
        \App\OptionsForChapters::create([
            'id_options' => '4',
            'id_chapter' => '1',
            'value' => 'skin-green',
            'array_permissions' => '1',
        ]);
        \App\OptionsForChapters::create([
            'id_options' => '5',
            'id_chapter' => '1',
            'value' => 'on',
            'array_permissions' => '1',
        ]);
        \App\OptionsForChapters::create([
            'id_options' => '6',
            'id_chapter' => '1',
            'value' => '3',
            'array_permissions' => '1',
        ]);
        \App\OptionsForChapters::create([
            'id_options' => '7',
            'id_chapter' => '1',
            'value' => '7',
            'array_permissions' => '1',
        ]);
    }
}
