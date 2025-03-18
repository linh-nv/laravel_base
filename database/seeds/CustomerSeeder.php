<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->truncate();
        DB::table('customers')->insert([
            ['name' => 'Nguyễn Văn A', 'phone' => '0123456789', 'address' => 'Hà Nội', 'identify_number' => '174589632'],
            ['name' => 'Nguyễn Văn B', 'phone' => '0128966789', 'address' => 'Hà Nội', 'identify_number' => '174589638'],
            ['name' => 'Nguyễn Văn C', 'phone' => '0123126789', 'address' => 'Hà Nội', 'identify_number' => '174589639']

        ]);
    }
}
