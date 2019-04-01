<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'gender',
        'email',
        'password',
        'phone',
        'date_of_birth',
        'address',
        'position_code',
        'department_id',
        'position_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password']=bcrypt($value);
    }

    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function position(){
        return $this->belongsTo('App\Position');
    }

    public function attendance(){
        return $this->hasMany('App\Attendance');
    }


}
