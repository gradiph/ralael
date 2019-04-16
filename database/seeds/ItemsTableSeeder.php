<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Item::class, 9)->create()->each(function ($item) {
            //prepare unique tag_id
            $tag_ids = range(1, 9);
            shuffle($tag_ids);

            $item->tags()->attach(array_slice($tag_ids, 0, mt_rand(1, 3)));
        });
    }
}
