<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Employee;
use App\Http\Requests\EmployeeProfileRequest;
use App\Http\Requests\EmployeesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $employee=Employee::find(Auth::user()->id);
        return view('employee_profile.index',compact('employee'));
    }

    public function update(EmployeeProfileRequest $request, $id)
    {
        $employee=Employee::find($id);
        $employee->update($request->all());

        session()->flash('profile_edit', 'Your profile has been updated.');

        $employee_id = Auth::user()->id;
        $employee = Employee::find($employee_id);

        $attendances = Attendance::where('employee_id', $employee_id)->paginate(4);


        return view('employee.index', compact('attendances', 'employee'));
    }
}
