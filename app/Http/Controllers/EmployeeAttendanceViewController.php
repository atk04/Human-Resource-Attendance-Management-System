<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Employee;
use App\Http\Requests\SearchAttendanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeAttendanceViewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employee_id = Auth::user()->id;
        $employee = Employee::find($employee_id);

        $attendances = Attendance::where('employee_id', $employee_id)->paginate(4);


        return view('employee.index', compact('attendances', 'employee'));
    }

    public function search(SearchAttendanceRequest $request)
    {
        $employee_id = Auth::user()->id;
        $employee = Employee::find($employee_id);
        $attendances = Attendance::where('employee_id', '=', $employee_id)->where('date', 'LIKE', "%{$request->search_month}%")->paginate(4);

        return view('employee.index', compact('attendances', 'employee'));

    }
}
