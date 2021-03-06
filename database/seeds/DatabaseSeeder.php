<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('--------------------------------');
        $this->command->info('START');
        $this->command->info('--------------------------------');
         $this->call(additionalServisesType::class);
        $this->command->info('--------------------------------');
        $this->command->info('The Additional Services table has been seeded!');
        $this->command->info('--------------------------------');
         $this->call(role::class);
        $this->command->info('--------------------------------');
        $this->command->info('The Roles table has been seeded!');
        $this->command->info('--------------------------------');
         $this->call(users::class);
        $this->command->info('--------------------------------');
        $this->command->info('The Users Services table has been seeded!');
        $this->command->info('--------------------------------');
         $this->call(discountType::class);
        $this->command->info('--------------------------------');
        $this->command->info('The Discount Services table has been seeded!');
        $this->command->info('--------------------------------');
         $this->call(tickets::class);
        $this->command->info('--------------------------------');
        $this->command->info('The Tickets Services table has been seeded!');
        $this->command->info('--------------------------------');
         $this->call(statusesTickets::class);
        $this->command->info('--------------------------------');
        $this->command->info('The Statuses Ticket Services table has been seeded!');
        $this->command->info('--------------------------------');
         $this->call(statusesClient::class);
        $this->command->info('--------------------------------');
        $this->command->info('The Statuses Client table has been seeded!');
        $this->command->info('--------------------------------');
        $this->call(traning_details::class);
        $this->command->info('--------------------------------');
        $this->command->info('The tranings_detail table has been seeded!');
        $this->command->info('--------------------------------');
        $this->call(traning_to_weeks::class);
        $this->command->info('--------------------------------');
        $this->command->info('The tranings_detail table has been seeded!');
        $this->command->info('--------------------------------');
        $this->call(traning_to_user::class);
        $this->command->info('--------------------------------');
        $this->command->info('The tranings_detail table has been seeded!');
        $this->command->info('--------------------------------');
        $this->call(options::class);
        $this->command->info('--------------------------------');
        $this->command->info('The options table has been seeded!');
        $this->command->info('--------------------------------');
        $this->call(typeVariables::class);
        $this->command->info('--------------------------------');
        $this->command->info('The options table has been seeded!');
        $this->command->info('--------------------------------');
        $this->call(Chapters::class);
        $this->command->info('--------------------------------');
        $this->command->info('The options table has been seeded!');
        $this->command->info('--------------------------------');
        $this->call(Rooms::class);
        $this->command->info('--------------------------------');
        $this->command->info('The options table has been seeded!');
        $this->command->info('--------------------------------');
        $this->call(clientsSeederMustBeDeleted::class);
        $this->command->info('--------------------------------');
        $this->command->info('The clients table has been seeded! For delete');
        $this->command->info('--------------------------------');
        $this->call(clientToTicketsMustBeDeleted::class);
        $this->command->info('--------------------------------');
        $this->command->info('The clientToTickets table has been seeded! For delete');
        $this->command->info('--------------------------------');
        $this->call(JoinTrainerToRoom::class);
        $this->command->info('--------------------------------');
        $this->command->info('The JoinTrainerToRoom table has been seeded!');
        $this->command->info('--------------------------------');
//        $this->call(options_for_chapters::class);
        $this->command->info('--------------------------------');
        $this->command->info('END');
        $this->command->info('--------------------------------');
    }
}
