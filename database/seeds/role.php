<?php

use Illuminate\Database\Seeder;

class role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create([
            'name' => 'Адмін',
        ]);

        \App\Role::create([
            'name' => 'Менеджер',
        ]);

        \App\Role::create([
            'name' => 'Тренер',
        ]);
    }
}
