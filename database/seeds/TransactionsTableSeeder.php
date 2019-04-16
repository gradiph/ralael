<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Transaction::class, 5)->create()->each(function ($transaction) {
            //prepare unique item_id
            $item_ids = range(1, 9);
            shuffle($item_ids);

            for ($i = 0; $i < mt_rand(1, 4); $i++) {
                $transaction->items()->attach(array_shift($item_ids), [
                    'qty' => mt_rand(1,2),
                    'price' => mt_rand(),
                    'note' => '',
                ]);
            }

            //prepare unique status_id
            $status_ids = range(1, 3);
            shuffle($status_ids);

            for ($i = 0; $i < mt_rand(1, 3); $i++) {
                $transaction->statuses()->attach(array_shift($status_ids), [
                    'admin_id' => mt_rand(1, 2),
                    'description' => '',
                    'creation_time' => Carbon::now(),
                ]);
            }
        });
    }
}
