<?php

namespace App\Http\Controllers;

use App\Holiday;
use Illuminate\Http\Request;

class EmployeeHolidayViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function employee_calendar(){
        $holidays = Holiday::paginate(4);
        return view('holidays.employee_calendar',compact('holidays'));
    }


}
