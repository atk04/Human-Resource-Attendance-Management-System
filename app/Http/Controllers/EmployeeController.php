<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Department;
use App\Employee;
use App\Http\Requests\EmployeesRequest;
use App\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $employees = Employee::paginate(4);
        return view('admin_employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $departments = Department::pluck('name', 'id');
        $positions = Position::pluck('name', 'id');

        if (count($departments) == 0) {
            session()->flash('department_check', 'Please add department first');
            return redirect('admin/department');
        } else if (count($positions) == 0) {
            session()->flash('position_check', 'Please add employee position first');
            return redirect('admin/position');
        } else {
            return view('admin_employees.create', compact('departments', 'positions'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeesRequest $request)
    {



        $employees = Employee::all();
        foreach ($employees as $employee) {
            if ($employee->email == $request->email) {
                $request->session()->flash('email_check', 'Email is already exit.');
                return back()->withInput();
            }
        }


        $position_id = $request->position_id;
        $position_code = Position::select('code')->where('id', $position_id)->get('code');
        $code = "";
        foreach ($position_code as $c) {
            $code = $c->code;
        }



        $count = 0;
        $current_code_length = strlen($code);

        $employee_position_code = $code;
        if ($current_code_length == 1) {
            $employee_position_code .= "0000";
        } elseif ($current_code_length == 2) {
            $employee_position_code .= "000";
        } elseif ($current_code_length == 3) {
            $employee_position_code .= "00";
        } elseif ($current_code_length == 4) {
            $employee_position_code .= "0";
        }


        $current_code_value=0;

        foreach ($employees as $e) {
            $exit_code = substr($e->position_code, 0, strlen($code));
            if ($exit_code == $code) {
                $current_code_value=substr($e->position_code,strlen($employee_position_code));

            }
        }



        if($current_code_value!=0) {
            $employee_position_code .= $current_code_value + 1;
        }else{
            $employee_position_code .=1;
        }




        $request->request->add(['position_code' => $employee_position_code]);
        Employee::create($request->all());
        $request->session()->flash('employee_create', 'Employee has been created');
        return redirect('admin/employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::find($id);
        $departments = Department::pluck('name', 'id');
        $positions = Position::pluck('name', 'id');

        return view('admin_employees.edit', compact('employees', 'departments', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeesRequest $request, $id)
    {
        $employee = Employee::find($id);





        $position_id = $request->position_id;
        $position_code = Position::select('code')->where('id', $position_id)->get('code');
        $code = "";
        foreach ($position_code as $c) {
            $code = $c->code;
        }

        $count = 0;
        $current_code_length = strlen($code);
        $employee_position_code = $code;
        if ($current_code_length == 1) {
            $employee_position_code .= "0000";
        } elseif ($current_code_length == 2) {
            $employee_position_code .= "000";
        } elseif ($current_code_length == 3) {
            $employee_position_code .= "00";
        } elseif ($current_code_length == 4) {
            $employee_position_code .= "0";
        }

        $employees=Employee::all();
        foreach ($employees as $e) {
            $exit_code = substr($e->position_code, 0, strlen($code));
            if ($exit_code == $code) {
                $count++;
            }
        }
        $test=$employee_position_code;
        $test.= $count;
        if($test==$employee->position_code){
            $employee_position_code .= $count;
        }else{
            $employee_position_code .= $count + 1;
        }



        $request->request->add(['position_code' => $employee_position_code]);


        $employee->update($request->all());
        $request->session()->flash('employee_update', 'Employee has been updated');


        return redirect('admin/employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Employee::find($id)->delete();
        Attendance::where('employee_id',$id)->delete();
        session()->flash('employee_delete', 'Employee has been deleted');
        return redirect('admin/employee');
    }
}
