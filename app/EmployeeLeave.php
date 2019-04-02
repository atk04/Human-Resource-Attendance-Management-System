<?php

namespace App;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{



    protected $fillable=[
      'start_date',
        'end_date',
        'number_of_day',
        'submit_date',
        'remain_day',
        'leave_status',
        'employee_id',
        'leave_type_id',

    ];

    public function leaveType(){
        return $this->belongsTo('App\LeaveType');
    }

    public function employee(){
        return $this->belongsTo('App\Employee');
    }

    public function getDatesFromRange($start, $end, $format = 'Y-m-d')
    {
        $array = array();
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        foreach ($period as $date) {
            $array[] = $date->format($format);
        }

        return $array;
    }




}
