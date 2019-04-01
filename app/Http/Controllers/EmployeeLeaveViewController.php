<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Employee;
use App\EmployeeLeave;
use App\Holiday;
use App\Http\Requests\EmployeesLeaveRequest;
use App\LeaveType;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLeaveViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $employee_id = Auth::user()->id;


        $employee_leaves = EmployeeLeave::where('employee_id', $employee_id)->paginate(4);


        return view('employee_leave_view.index', compact('employee_leaves'));
    }

    public function create()
    {

        $leave_types = LeaveType::pluck('name', 'id')->all();
        $submit_date = date('Y-m-d');
        return view('employee_leave_view.create', compact('leave_types', 'submit_date'));
    }

    public function store(EmployeesLeaveRequest $request)
    {


        $request->request->add(['leave_status' => "Pending"]);
        $request->request->add(['employee_id' => Auth::user()->id]);
        $leave_start_date = $request->start_date;
        $leave_end_date = $request->end_date;

        if (strtotime($leave_start_date) > strtotime($leave_end_date)) {
            session()->flash('leave_date_check', 'leave end date must greater than leave start date');
            return back()->withInput();
        }
        $valid_start_and_end_leave_date_array = [];
        $employee_leaves = EmployeeLeave::where('employee_id', Auth::user()->id)->get();

        foreach ($employee_leaves as $employee_leave) {

            $valid_start_and_end_leave_date_array[] = $employee_leave->getDatesFromRange($employee_leave->start_date, $employee_leave->end_date);
        }

        $total_start_and_end_leave_date = [];

        for ($i = 0; $i < count($valid_start_and_end_leave_date_array); $i++) {
            for ($j = 0; $j < count($valid_start_and_end_leave_date_array[$i]); $j++) {
                $total_start_and_end_leave_date[] = $valid_start_and_end_leave_date_array[$i][$j];
            }
        }

        if (in_array($leave_start_date, $total_start_and_end_leave_date) || in_array($leave_end_date, $total_start_and_end_leave_date)) {
            session()->flash('leave_date_exist_check', 'leave days is already exist between current submit leave days.');
            return back()->withInput();
        }

        $attendances = Attendance::where('employee_id', Auth::user()->id)->get();
        $valid_attendance_date = [];
        foreach ($attendances as $attendance) {
            $valid_attendance_date[] = $attendance->date;
        }


        if (in_array($leave_start_date, $valid_attendance_date) || in_array($leave_end_date, $valid_attendance_date)) {
            session()->flash('attendance_date_exist_check', 'Cannot add because attendance date exist within leave start date and end date.');
            return back()->withInput();
        }

        $start_date_time = new DateTime($leave_start_date);
        $end_date_time = new DateTime($leave_end_date);
        $start_year_format = $start_date_time->format('Y');
        $end_year_format = $end_date_time->format('Y');
        if ($start_year_format != $end_year_format) {
            session()->flash('leave_year_valid_check', 'Year of leave start date and leave end date  must be the same');
            return back()->withInput();
        }

        $temp_date = new DateTime($leave_start_date);
        $temp_date->modify('-1 day');
        $holidays = Holiday::all();
        $total_holiday = [];
        foreach ($holidays as $holiday) {
            $total_holiday[] = $holiday->date;
        }

        $backdate = $temp_date->format('Y-m-d');

        $backdate_time = strtotime($backdate);
        $ConverDate = date("l", $backdate_time);
        $ConverDateTomatch = strtolower($ConverDate);
        $leave_day_count = 0;

        while (($ConverDateTomatch == "saturday") || ($ConverDateTomatch == "sunday") || in_array($backdate, $total_holiday)) {

            $leave_day_count = $leave_day_count + 1;
            $temp = new DateTime($backdate);
            $temp->modify('-1 day');
            $backdate = $temp->format('Y-m-d');
            $backdate_time = strtotime($backdate);
            $ConverDate = date("l", $backdate_time);
            $ConverDateTomatch = strtolower($ConverDate);
        }

        if ($leave_day_count > 0) {

            $temp1 = new DateTime($backdate);
            $temp1->modify('+1 day');
            $backdate = $temp1->format('Y-m-d');
        }

        if (in_array($backdate, $total_start_and_end_leave_date)) {
            $current_employee_leave = new EmployeeLeave();
            $current_leave_range = $current_employee_leave->getDatesFromRange($request->start_date, $request->end_date);


            $count_current_leave_range = count($current_leave_range) + $leave_day_count;
        } else if (in_array($backdate, $total_holiday)) {
            $current_employee_leave = new EmployeeLeave();
            $current_leave_range = $current_employee_leave->getDatesFromRange($request->start_date, $request->end_date);


            $count_current_leave_range = count($current_leave_range) + $leave_day_count;


        } else {
            $current_employee_leave = new EmployeeLeave();
            $current_leave_range = $current_employee_leave->getDatesFromRange($request->start_date, $request->end_date);
            $count_current_leave_range = count($current_leave_range);


        }


        $curent_max_day=0;
        $leave_types = LeaveType::where('id', $request->leave_type_id)->get();
        foreach ($leave_types as $leave_type){
            $curent_max_day=$leave_type->max_leave_day;
        }



        $total_request_number_of_day=0;
        $employee_leaves_with_type=EmployeeLeave::where('employee_id','=',Auth::user()->id)->where('leave_type_id',$request->leave_type_id)->where('leave_status','!=','Reject')->where('start_date','LIKE',"%{$start_year_format}%")->get();
        foreach ($employee_leaves_with_type as $type){
            $total_request_number_of_day+=$type->number_of_day;
        }

        $total_request_number_of_day+=$count_current_leave_range;
        $remain_day=$curent_max_day-$total_request_number_of_day;
        if($remain_day<0){
            session()->flash('remain_day_check', 'Your maximum days of leave type per Year is reached');
            return back()->withInput();
        }else{
            $request->request->add(['remain_day' => $remain_day]);
        }

        $request->request->add(['number_of_day' => $count_current_leave_range]);
        $request->request->add(['submit_date' => Carbon::now()->format('Y-m-d')]);


        EmployeeLeave::create($request->all());

        session()->flash('employee_leave_create', 'Your leave days has been submitted.');
        return redirect('employee/leave');

    }
}
