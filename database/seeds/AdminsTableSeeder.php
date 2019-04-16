<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@ralael.id',
            'password' => 'admin',
        ]);

        Admin::create([
            'name' => 'Admin 2',
            'email' => 'admin2@ralael.id',
            'password' => 'admin',
        ]);
    }
}
