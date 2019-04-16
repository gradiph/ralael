<?php

use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            AdminsTableSeeder::class,
            CategoriesTableSeeder::class,
            TagsTableSeeder::class,
            StatusTableSeeder::class,
            RecipientsTableSeeder::class,
            ItemsTableSeeder::class,
            TransactionsTableSeeder::class,
            CartsTableSeeder::class,
            ImagesTableSeeder::class,
            PaymentsTableSeeder::class,
            LogsTableSeeder::class,
            CashflowsTableSeeder::class,
        ]);
    }
}
