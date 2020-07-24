<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrizeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prizes_types')->insert([
            'name' => 'Money',
            'count' => 15,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('prizes_types')->insert([
            'name' => 'Bonus',
            'count' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('prizes_types')->insert([
            'name' => 'Item',
            'count' => 15,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
