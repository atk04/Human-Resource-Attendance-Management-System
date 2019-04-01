<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'name'=>'Software',
            'address'=>'251 Rice Divide Niaberg, MT 41210-9709'
        ]);
        DB::table('departments')->insert([
            'name'=>'Hardware',
            'address'=>'51927 Elinore Valleys East Myriamview, MT 03275-6999'
        ]);
    }
}
