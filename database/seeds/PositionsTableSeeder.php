<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            'code'=>'HOD',
            'name'=>'Head of Department'
        ]);
        DB::table('positions')->insert([
            'code'=>'PM',
            'name'=>'Project Manager'
        ]);

        DB::table('positions')->insert([
            'code'=>'SA',
            'name'=>'System Analysis'
        ]);


        DB::table('positions')->insert([
            'code'=>'WD',
            'name'=>'Web Developer'
        ]);
    }
}
