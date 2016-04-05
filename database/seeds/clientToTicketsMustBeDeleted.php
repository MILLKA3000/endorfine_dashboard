<?php

use Illuminate\Database\Seeder;

class clientToTicketsMustBeDeleted extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($x = 0; $x <300; $x++) {
            {
                \App\ClientsToTickets::create([
                    'numTicket' => $x + 1,
                    'ticket_id' => rand(1, 8),
                    'client_id' => $x + 1,
                    'discount_id' => rand(5, 8),
                    'statusTicket_id' => '2',
                ]);
            }
        }
    }
}
