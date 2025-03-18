<?php

use Illuminate\Database\Seeder;

class InvoiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('invoice_types')->truncate();
        DB::table('invoice_types')->insert([
            ['name' => 'Góp vốn','is_system'=>1],
            ['name' => 'Rút vốn','is_system'=>1],
            ['name' => 'Cho vay','is_system'=>1],
            ['name' => 'Thu lãi','is_system'=>1],
            ['name' => 'Trả gốc','is_system'=>1],
        ]);
    }
}
