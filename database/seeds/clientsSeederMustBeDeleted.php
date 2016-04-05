<?php

use Illuminate\Database\Seeder;

class clientsSeederMustBeDeleted extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($x = 0; $x <300; $x++)
        {
            if ($x < 101)
            {
                \App\Client::create([
                    'name' => 'Руслан Міськів',
                    'phone' => '(111) 111-11-11',
                    'photo' => '/img/no-user-image.gif',
                    'birthday' => date('Y-m-d', strtotime('+' . mt_rand(0, 100) . ' days')),
                    'status_id' => rand(1, 4),
                    'enabled' => '1'
                ]);
            }
            elseif ($x < 201)
            {
                \App\Client::create([
                    'name' => 'Сергій Чеканов',
                    'phone' => '(222) 222-22-22',
                    'photo' => '/img/no-user-image.gif',
                    'birthday' => date('Y-m-d', strtotime('+' . mt_rand(0, 100) . ' days')),
                    'status_id' => rand(1, 4),
                    'enabled' => '1'
                ]);
            }
            elseif ($x < 301)
            {
                \App\Client::create([
                    'name' => 'Дмитро Чернецький',
                    'phone' => '(333) 333-33-33',
                    'photo' => '/img/no-user-image.gif',
                    'birthday' => date('Y-m-d', strtotime('+' . mt_rand(0, 100) . ' days')),
                    'status_id' => rand(1, 4),
                    'enabled' => '1'
                ]);
            }
        }
    }
}
