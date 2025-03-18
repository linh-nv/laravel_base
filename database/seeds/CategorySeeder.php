<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('categories')->insert([
            ['code' => 'XEMAY', 'name' => 'xe máy', 'recommend_amount' => '10'],
            ['code' => 'OTO', 'name' => 'ô tô', 'recommend_amount' => '20'],
            ['code' => 'SODO', 'name' => 'sổ đỏ', 'recommend_amount' => '8']

        ]);
    }
}
