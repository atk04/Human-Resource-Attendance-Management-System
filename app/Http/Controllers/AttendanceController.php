<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Department;
use App\Employee;
use App\Holiday;
use App\Http\Requests\AttendancesEditRequest;
use App\Http\Requests\AttendancesRequest;
use App\Schedule;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AttendanceController extends Controller
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

        return view('attendances.index', compact('employees'));
    }


    public function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = Employee::where('position_code', 'LIKE', "%{$query}%")->get();

            $output = "";
            foreach ($data as $row) {
                $output .= '<li class="attendance"><a href="#" class="dropdown-item" >' . $row->position_code . '</a></li>';
            }

            echo $output;
        }
    }

    public function search(Request $request)
    {
        $position_code = $request->position_code;
        $employees = Employee::where('position_code', 'LIKE', "%{$position_code}%")->paginate(4);
        return view('attendances.search_result', compact('employees'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttendancesRequest $request)
    {

        $departments = Department::all();
        if (count($departments) == 0) {
            session()->flash('department_check', 'Please add department first');
            return redirect('admin/department');
        }

        $schedule = Schedule::all();
        if (count($schedule) == 0) {
            session()->flash('schedule_empty_check', 'Please add schedule first');
            return redirect('admin/schedule');
        }


        $attendance_date = $request->date;
        $holidays = Holiday::all();
        foreach ($holidays as $holiday) {
            if ($holiday->date == $attendance_date) {
                $request->session()->flash('holiday_check', 'Selected date is official holiday. Please choose another');
                return back()->withInput();
            }
        }


        $attendances = Attendance::where('employee_id',$request->employee_id)->get();


        foreach ($attendances as $attendance) {
            if ($attendance->date == $attendance_date) {
                $request->session()->flash('attendance_date_check', 'This attendance date is already exist. Please choose another');
                return back()->withInput();
            }
        }

        $in_time_date = new DateTime($request->time_in);
        $time_in = strtotime($in_time_date->format('g:i A'));

        $out_time_date = new DateTime($request->time_out);
        $time_out = strtotime($out_time_date->format('g:i A'));

        if ($time_in > $time_out) {
            $request->session()->flash('attendance_time_check', 'In time must not greater than out time.');
            return back()->withInput();
        }


        $employee_id = $request->employee_id;


        $employee = Employee::where('id', $employee_id)->get();


        $department_id = 0;
        foreach ($employee as $e) {
            $department_id = $e->department_id;
        }


        $schedule_start_date = null;
        $schedule_end_date = null;
        $schedules = Schedule::where('department_id', $department_id)->get();
        foreach ($schedules as $schedule) {
            $schedule_start_date = new DateTime($schedule->start_time);
            $schedule_end_date = new DateTime($schedule->end_time);
        }

        $schedule_start_time = strtotime($schedule_start_date->format('g:i A'));
        $schedule_end_time = strtotime($schedule_end_date->format('g:i A'));
        $schedule_time_count = $schedule_end_time - $schedule_start_time;


        $in_time_date = new DateTime($request->time_in);
        $time_in = strtotime($in_time_date->format('g:i A'));

        $out_time_date = new DateTime($request->time_out);
        $time_out = strtotime($out_time_date->format('g:i A'));


        $current_time_count = $time_out - $time_in;
        $is_overtime = false;
        $is_undertime = false;
        if ($schedule_time_count > $current_time_count) {
            $result_time_count = $schedule_time_count - $current_time_count;
            $is_undertime = true;

        }

        if ($current_time_count > $schedule_time_count) {
            $result_time_count = $current_time_count - $schedule_time_count;
            $is_overtime = true;
        }


        $overtime_format = "";
        $undertime_format = "";
        if ($is_overtime) {
            $total_overtime_hour = floor($result_time_count / (60 * 60));
            $total_overtime_minute = ($result_time_count - $total_overtime_hour * (60 * 60)) / 60;

            if ($total_overtime_hour > 1) {
                $o_hour = " hours";
            } else {
                $o_hour = " hour";
            }

            if ($total_overtime_minute > 1) {
                $o_minute = " minutes";
            } else {
                $o_minute = " minute";
            }

            if ($total_overtime_hour > 0 && $total_overtime_minute <= 0) {
                $overtime_format = $total_overtime_hour . $o_hour;
            } elseif ($total_overtime_hour <= 0 && $total_overtime_minute > 0) {
                $overtime_format .= $total_overtime_minute . $o_minute;
            } elseif ($total_overtime_hour > 0 && $total_overtime_minute > 0) {
                $overtime_format .= $total_overtime_hour . $o_hour . " and " . $total_overtime_minute . $o_minute;
            }


        } else {
            $overtime_format .= "-";
        }


        if ($is_undertime) {
            $total_undertime_hour = floor($result_time_count / (60 * 60));
            $total_undertime_minute = ($result_time_count - $total_undertime_hour * (60 * 60)) / 60;

            if ($total_undertime_hour > 1) {
                $o_hour = " hours";
            } else {
                $o_hour = " hour";
            }

            if ($total_undertime_minute > 1) {
                $o_minute = " minutes";
            } else {
                $o_minute = " minute";
            }

            if ($total_undertime_hour > 0 && $total_undertime_minute <= 0) {
                $undertime_format = $total_undertime_hour . $o_hour;
            } elseif ($total_undertime_hour <= 0 && $total_undertime_minute > 0) {
                $undertime_format .= $total_undertime_minute . $o_minute;
            } elseif ($total_undertime_hour > 0 && $total_undertime_minute > 0) {
                $undertime_format .= $total_undertime_hour . $o_hour . " and " . $total_undertime_minute . $o_minute;
            }


        } else {
            $undertime_format .= "-";
        }
        $request->request->add(['employee_id' => $employee_id]);
        $request->request->add(['admin_id' => Auth::user()->id]);
        $request->request->add(['overtime_hour' => $overtime_format]);
        $request->request->add(['undertime_hour' => $undertime_format]);


        Attendance::create($request->all());
        $request->session()->flash('attendance_create', 'Attendance has been created');
        return redirect('admin/attendance');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('attendances.create', compact('employee'));
    }

    /**
     * Show the form for view and editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function viewandedit($id)
    {
        $employee = Employee::find($id);
        $employee_id = $employee->id;
        $attendances = Attendance::where('employee_id', $employee_id)->paginate(4);

        return view('attendances.viewandedit', compact('attendances'));
    }

    /**
     * Show the form for editing the specified resource_.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attendance = Attendance::find($id);
        $employee_id = Employee::find($attendance->employee_id);

        return view('attendances.edit', compact('attendance', 'employee_id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttendancesEditRequest $request, $id)
    {

        $attendance = Attendance::find($id);


        $employee_id = $attendance->employee_id;


        $in_time_date = new DateTime($request->time_in);
        $time_in = strtotime($in_time_date->format('g:i A'));

        $out_time_date = new DateTime($request->time_out);
        $time_out = strtotime($out_time_date->format('g:i A'));

        if ($time_in > $time_out) {
            $request->session()->flash('attendance_time_check', 'In time must not greater than out time.');
            return back()->withInput();
        }


        $employee = Employee::where('id', $employee_id)->get();


        $department_id = 0;
        foreach ($employee as $e) {
            $department_id = $e->department_id;
        }


        $schedule_start_date = null;
        $schedule_end_date = null;
        $schedules = Schedule::where('department_id', $department_id)->get();
        foreach ($schedules as $schedule) {
            $schedule_start_date = new DateTime($schedule->start_time);
            $schedule_end_date = new DateTime($schedule->end_time);
        }

        $schedule_start_time = strtotime($schedule_start_date->format('g:i A'));
        $schedule_end_time = strtotime($schedule_end_date->format('g:i A'));
        $schedule_time_count = $schedule_end_time - $schedule_start_time;


        $in_time_date = new DateTime($request->time_in);
        $time_in = strtotime($in_time_date->format('g:i A'));

        $out_time_date = new DateTime($request->time_out);
        $time_out = strtotime($out_time_date->format('g:i A'));


        $current_time_count = $time_out - $time_in;
        $is_overtime = false;
        $is_undertime = false;
        if ($schedule_time_count > $current_time_count) {
            $result_time_count = $schedule_time_count - $current_time_count;
            $is_undertime = true;

        }

        if ($current_time_count > $schedule_time_count) {
            $result_time_count = $current_time_count - $schedule_time_count;
            $is_overtime = true;
        }


        $overtime_format = "";
        $undertime_format = "";
        if ($is_overtime) {
            $total_overtime_hour = floor($result_time_count / (60 * 60));
            $total_overtime_minute = ($result_time_count - $total_overtime_hour * (60 * 60)) / 60;

            if ($total_overtime_hour > 1) {
                $o_hour = " hours";
            } else {
                $o_hour = " hour";
            }

            if ($total_overtime_minute > 1) {
                $o_minute = " minutes";
            } else {
                $o_minute = " minute";
            }

            if ($total_overtime_hour > 0 && $total_overtime_minute <= 0) {
                $overtime_format = $total_overtime_hour . $o_hour;
            } elseif ($total_overtime_hour <= 0 && $total_overtime_minute > 0) {
                $overtime_format .= $total_overtime_minute . $o_minute;
            } elseif ($total_overtime_hour > 0 && $total_overtime_minute > 0) {
                $overtime_format .= $total_overtime_hour . $o_hour . " and " . $total_overtime_minute . $o_minute;
            }


        } else {
            $overtime_format .= "-";
        }


        if ($is_undertime) {
            $total_undertime_hour = floor($result_time_count / (60 * 60));
            $total_undertime_minute = ($result_time_count - $total_undertime_hour * (60 * 60)) / 60;

            if ($total_undertime_hour > 1) {
                $o_hour = " hours";
            } else {
                $o_hour = " hour";
            }

            if ($total_undertime_minute > 1) {
                $o_minute = " minutes";
            } else {
                $o_minute = " minute";
            }

            if ($total_undertime_hour > 0 && $total_undertime_minute <= 0) {
                $undertime_format = $total_undertime_hour . $o_hour;
            } elseif ($total_undertime_hour <= 0 && $total_undertime_minute > 0) {
                $undertime_format .= $total_undertime_minute . $o_minute;
            } elseif ($total_undertime_hour > 0 && $total_undertime_minute > 0) {
                $undertime_format .= $total_undertime_hour . $o_hour . " and " . $total_undertime_minute . $o_minute;
            }


        } else {
            $undertime_format .= "-";
        }
        $request->request->add(['employee_id' => $employee_id]);
        $request->request->add(['admin_id' => Auth::user()->id]);
        $request->request->add(['overtime_hour' => $overtime_format]);
        $request->request->add(['undertime_hour' => $undertime_format]);


        $attendance->update($request->all());

        session()->flash('attendance_update', 'Attendance has been updated');


        $attendances = Attendance::where('employee_id', $employee_id)->paginate(4);

        return view('attendances.viewandedit', compact('attendances'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Attendance::find($id)->delete();
        session()->flash('attendance_delete', 'Attendance has been deleted');
        return back()->withInput();


    }
}
