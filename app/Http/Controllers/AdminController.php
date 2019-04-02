<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Department;
use App\Employee;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allDepartment = Department::all();
        $department_count = 0;
        foreach ($allDepartment as $department) {
            $department_id = $department->id;
            if ($department_id != 0) {
                $department_count++;
            }
        }

        $allEmployee = Employee::all();
        $employee_count = 0;
        foreach ($allEmployee as $employee) {
            $employee_id = $employee->id;
            if ($employee_id != 0) {
                $employee_count++;
            }
        }

        $previous_week = strtotime("-1 week +1 day");

        $start_week = strtotime("last sunday midnight", $previous_week);
        $end_week = strtotime("next saturday", $start_week);

        $start_week = date("Y-m-d", $start_week);
        $end_week = date("Y-m-d", $end_week);


        $getAttendanceEntryWeek = Attendance::whereBetween('date',[$start_week,$end_week])->get();
        $date_count=0;
        foreach($getAttendanceEntryWeek as $entry){
            $attendance_date=$entry->date;
            if($attendance_date!=null){
                $date_count++;
            }
        }



        return view('admin.index',compact('department_count','employee_count','date_count'));
    }
}
