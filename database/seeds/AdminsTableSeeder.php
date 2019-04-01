<?php

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
        DB::table('admins')->insert([
            'name'=>'Aung Thein Kyaw',
            'email'=>'amazingatk@gmail.com',
            'password'=>bcrypt('amazingatk')
        ]);
    }
}
