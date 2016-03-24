<?php

use Illuminate\Database\Seeder;

class tickets extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Ticket::create([
            'name' => 'Без абонемента',
            'detail' => 'Без абонемента',
            'qtySessions' => '0',
            'activityTime' => '0',
            'value' => '0',
            'enabled' => false
        ]);

        \App\Ticket::create([
            'name' => 'Абонемент на 8 занять',
            'detail' => 'Абонемент на 8 занять',
            'qtySessions' => '8',
            'activityTime' => '60',
            'value' => '240',
            'enabled' => true
        ]);

        \App\Ticket::create([
            'name' => 'Абонемент на 12 занять',
            'detail' => 'Абонемент на 12 занять',
            'qtySessions' => '12',
            'activityTime' => '60',
            'value' => '300',
            'enabled' => true
        ]);

        \App\Ticket::create([
            'name' => 'Безлім',
            'detail' => 'Безлім',
            'qtySessions' => '999',
            'activityTime' => '60',
            'value' => '450',
            'enabled' => true
        ]);

        \App\Ticket::create([
            'name' => 'Парний абонемент',
            'detail' => 'Абонемент на 2 особи для занять на Парному фітнесі',
            'qtySessions' => '8',
            'activityTime' => '60',
            'value' => '400',
            'enabled' => true
        ]);

        \App\Ticket::create([
            'name' => 'Одноразове заняття',
            'detail' => 'Одноразове заняття',
            'qtySessions' => '1',
            'activityTime' => '60',
            'value' => '40',
            'enabled' => true
        ]);

        \App\Ticket::create([
            'name' => 'Виграшне одноразове заняття',
            'detail' => 'Одноразове заняття',
            'qtySessions' => '1',
            'activityTime' => '60',
            'value' => '0',
            'enabled' => true
        ]);

        \App\Ticket::create([
            'name' => 'Виграшне дворазове заняття',
            'detail' => 'Дворазове заняття',
            'qtySessions' => '2',
            'activityTime' => '60',
            'value' => '0',
            'enabled' => true
        ]);
    }
}
