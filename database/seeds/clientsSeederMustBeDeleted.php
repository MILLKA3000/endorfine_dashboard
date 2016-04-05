<?php

use App\Models\Search;
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
                    'phone' => '('.rand(100, 999).') '.rand(100, 999).'-11-11',
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
                    'phone' => '('.rand(100, 999).') '.rand(100, 999).'-11-11',
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
                    'phone' => '('.rand(100, 999).') '.rand(100, 999).'-11-11',
                    'photo' => '/img/no-user-image.gif',
                    'birthday' => date('Y-m-d', strtotime('+' . mt_rand(0, 100) . ' days')),
                    'status_id' => rand(1, 4),
                    'enabled' => '1'
                ]);
            }
        }
    }
}
