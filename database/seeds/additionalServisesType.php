<?php

use Illuminate\Database\Seeder;

class additionalServisesType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\AdditionalServises::create([
            'name' => 'Оренда шкафчика',
            'detail' => 'Оренда шкафчика',
            'activityTime' => '30',
            'value' => '20',
            'enabled' => '1'
        ]);

    }
}
