<?php

use Illuminate\Database\Seeder;

class CashflowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Cashflow::class, 20)->create();
    }
}
