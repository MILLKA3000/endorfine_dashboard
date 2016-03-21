<?php

use Illuminate\Database\Seeder;

class statusesClient extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\ClientStatuses::create([
            'name' => 'Кліент',
            'discount_id' => 1
        ]);

        \App\ClientStatuses::create([
            'name' => 'VIP більше 1 року',
            'discount_id' => 2
        ]);

        \App\ClientStatuses::create([
            'name' => 'VIP більше 2 років',
            'discount_id' => 3
        ]);

        \App\ClientStatuses::create([
            'name' => 'VIP більше 3 років',
            'discount_id' => 4
        ]);
    }
}
