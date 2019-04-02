<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'department_id',
        'start_time',
        'end_time'
    ];

    public function setStartTimeAttribute($value)
    {
        $startTime = new DateTime($value);

        $this -> attributes['start_time'] = $startTime->format('H:i:s');
    }

    public function setEndTimeAttribute($value)
    {
        $endTime = new DateTime($value);
        $this -> attributes['end_time'] = $endTime->format('H:i:s');
    }

    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function getStartTimeAttribute($value)
    {
        return date("g:i A", strtotime($value));

    }

    public function getEndTimeAttribute($value)
    {
        return date("g:i A", strtotime($value));

    }
}
