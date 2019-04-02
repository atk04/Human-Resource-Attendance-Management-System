<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('admins')->truncate();
        DB::table('departments')->truncate();
        DB::table('schedules')->truncate();
        DB::table('leave_types')->truncate();
        $this->call(AdminsTableSeeder::class);
        $this->call(LeaveTypesTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);


        factory(App\Schedule::class,2)->create();


    }
}
