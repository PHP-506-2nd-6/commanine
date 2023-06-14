<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HanokTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hanoktypes')->insert([
            ['id' => '0', 'category' => '호텔']
        ,['id' => '1', 'category' => '펜션']
        ,['id' => '2', 'category' => '게스트하우스']
        ,['id' => '3', 'category' => '리조트']
        ]);
    }
}
