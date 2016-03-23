<?php

use Illuminate\Database\Seeder;

class statusesTickets extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\StatusesTicket::create([
            'name' => 'В резерві',
        ]);

        \App\StatusesTicket::create([
            'name' => 'Активний абонемент',
        ]);

        \App\StatusesTicket::create([
            'name' => 'Закритий абонемент',
        ]);

        \App\StatusesTicket::create([
            'name' => 'Просрочений абонемент',
        ]);
    }
}
