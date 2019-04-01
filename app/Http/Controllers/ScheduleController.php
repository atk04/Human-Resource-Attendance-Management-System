<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\SchedulesEditRequest;
use App\Http\Requests\SchedulesRequest;
use App\Schedule;
use DateTime;
use Illuminate\Http\Request;

class ScheduleController extends Controller
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
        $departments = Department::all();
        if (count($departments) == 0) {
            session()->flash('department_check', 'Please add department first');
            return redirect('admin/department');
        } else {
            $schedules = Schedule::paginate(4);
            return view('schedules.index', compact('schedules'));
        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::pluck('name', 'id')->all();
        if (count($departments) == 0) {
            session()->flash('department_check', 'Please add department first');
            return redirect('admin/department');
        } else {
            return view('schedules.create', compact('departments'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SchedulesRequest $request)
    {
        $department_id=$request->department_id;
        $result_set=Schedule::all();
        foreach($result_set as $result){
            if($result->department_id==$department_id){
                $request->session()->flash('department_schedule_exist_check', 'Schedule for this department is already exit.');
                return redirect('admin/schedule/create');
            }
        }


        $startTime = new DateTime($request->start_time);
        $endTime = new DateTime($request->end_time);
        $time_in = strtotime($startTime->format('g:i A'));

        $time_out = strtotime($endTime->format('g:i A'));
        if ($time_in > $time_out) {
            $request->session()->flash('schedule_time', 'Start time must not greater than the end time');
            return redirect('admin/schedule/create');
        } else {
            Schedule::create($request->all());
            $request->session()->flash('schedule_create', 'Department schedule has been created');
            return redirect('admin/schedule');
        }
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
        $schedule = Schedule::find($id);
        $departments = Department::find($schedule->department_id);
        $department_name=$departments->name;
        return view('schedules.edit', compact('schedule', 'department_name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SchedulesEditRequest $request, $id)
    {
        $startTime = new DateTime($request->start_time);
        $endTime = new DateTime($request->end_time);
        $time_in = strtotime($startTime->format('g:i A'));
        $time_out = strtotime($endTime->format('g:i A'));


        if ($time_in > $time_out) {
            $request->session()->reflash();

            $request->session()->flash('schedule_time', 'Start time must not greater than the end time');

            $request->session()->keep(['schedule_time']);


            return back()->withInput();
        } else {
            $schedule=Schedule::find($id);
            $schedule->update($request->all());
            $request->session()->flash('schedule_edit', 'Schedule has been updated');
            return redirect('admin/schedule');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Schedule::find($id)->delete();

        session()->flash('schedule_delete', 'Department schedule has been deleted');
        return redirect('admin/schedule');

    }
}
