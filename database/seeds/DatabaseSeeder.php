<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV', 'local') == 'local')
        {
            $this->call(DevelopmentSeeder::class);
        }
        else
        {
            $this->call(ProductionSeeder::class);
        }
    }
}
