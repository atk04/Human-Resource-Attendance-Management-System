<?php

use Illuminate\Database\Seeder;

class LeaveTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leave_types')->insert([
            'name'=>'Sick Leave',
            'max_leave_day'=>12
        ]);

        DB::table('leave_types')->insert([
            'name'=>'Casual Leave',
            'max_leave_day'=>12
        ]);

        DB::table('leave_types')->insert([
            'name'=>'Maternity Leave',
            'max_leave_day'=>135
        ]);

        DB::table('leave_types')->insert([
            'name'=>'Paternity Leave',
            'max_leave_day'=>15
        ]);
    }
}
