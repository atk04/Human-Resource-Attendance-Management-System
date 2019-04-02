<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeLeave;
use App\LeaveType;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
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

        return view('employee_leave.index', compact('employees'));
    }

    public function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = Employee::where('position_code', 'LIKE', "%{$query}%")->get();

            $output = "";
            foreach ($data as $row) {
                $output .= '<li class="leave"><a href="#" class="dropdown-item" >' . $row->position_code . '</a></li>';
            }

            echo $output;
        }
    }

    public function search(Request $request)
    {
        $position_code = $request->position_code;
        $employees = Employee::where('position_code', 'LIKE', "%{$position_code}%")->paginate(4);
        return view('employee_leave.search_result', compact('employees'));

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for view and editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function viewandedit($id)
    {
        $employee_leaves = EmployeeLeave::where('employee_id', '=', $id)->paginate(4);


        return view('employee_leave.viewandedit', compact('employee_leaves'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    public function approve(Request $request, $id)
    {
        $employee_leaves = EmployeeLeave::where('id', '=', $id)->get();


        foreach ($employee_leaves as $employee_leave) {
            $employee_id = $employee_leave->employee_id;
            $leave_type_id = $employee_leave->leave_type_id;
            $current_leave_number_of_day=$employee_leave->number_of_day;
        }

        $leave_type = LeaveType::find($leave_type_id);
        $max_leave_day = $leave_type->max_leave_day;


        $sum_check = EmployeeLeave::where('employee_id', $employee_id)->where('leave_type_id', $leave_type_id)->where('leave_status', '!=', 'Reject')->SUM('number_of_day');
        $sum_check+=$current_leave_number_of_day;

        if ($sum_check > $max_leave_day) {

            session()->flash('employee_approve_check', 'Cannot approved.Selected employee leave type have no more leave days.');
            return redirect()->back();
        } else {
            $employee_leaves = EmployeeLeave::find($id);
            $employee_leaves->update($request->all());
            session()->flash('employee_leave_approve', 'Selected employee leave has been approved');
            return redirect()->back();
        }
    }

    public function reject(Request $request, $id)
    {


        $employee_leaves = EmployeeLeave::find($id);
        $employee_leaves->update($request->all());
        session()->flash('employee_leave_reject', 'Selected employee leave has been rejected');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        EmployeeLeave::find($id)->delete();
        session()->flash('employee_leave_delete', 'Selected employee leave has been deleted');
        return back()->withInput();

    }
}
