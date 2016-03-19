<?php

use Illuminate\Database\Seeder;

class discountType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Discounts::create([
            'name' => 'Vip знижка для кліентів більше 1 року',
            'detail' => 'Vip знижка для кліентів більше 1 року',
            'percent' => '5',
            'status' => '1',
            'enabled' => '1'
        ]);

        \App\Discounts::create([
            'name' => 'Vip знижка для кліентів більше 2 років',
            'detail' => 'Vip знижка для кліентів більше 2 років',
            'percent' => '7',
            'status' => '1',
            'enabled' => '1'
        ]);

        \App\Discounts::create([
            'name' => 'Vip знижка для кліентів більше 3 років',
            'detail' => 'Vip знижка для кліентів більше 3 років',
            'percent' => '10',
            'status' => '1',
            'enabled' => '1'
        ]);

        \App\Discounts::create([
            'name' => 'Студентська знижка',
            'detail' => 'Студентська знижка. При придявленні студентського квитка',
            'percent' => '10',
            'status' => '2',
            'enabled' => '1'
        ]);

        \App\Discounts::create([
            'name' => 'Завжди 18',
            'detail' => 'Пенсійна знижка',
            'percent' => '18',
            'status' => '2',
            'enabled' => '1'
        ]);

        \App\Discounts::create([
            'name' => 'Обідня знижка',
            'detail' => 'Знижка для занять в обідний час. Від 14 00 до 16 00 включно',
            'percent' => '20',
            'status' => '2',
            'enabled' => '1'
        ]);

        \App\Discounts::create([
            'name' => 'Знижка для адміністратора',
            'detail' => 'Знижка для адміністратора',
            'percent' => '100',
            'status' => '2',
            'enabled' => '1'
        ]);
    }
}
