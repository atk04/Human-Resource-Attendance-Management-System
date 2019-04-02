@extends('layouts.AdminDashboard')


@section('content')

    <div class="card mr-5" style="width:23em;height:12em;">
        <div class="card-header" style="background-color:lightgreen">
            DEPARTMENT

        </div>
        <div class="card-body collapse show">
            <p style="font-size:3em;" class="counter">{{$department_count}}</p>

        </div>

    </div>

    <div class="card mr-5" style="width:23em;height:12em;">
        <div class="card-header" style="background-color:plum">
            EMPLOYEE

        </div>
        <div class="card-body collapse show">
            <p style="font-size:3em;" class="counter">{{$employee_count}}</p>
        </div>
    </div>

    <div class="card mr-5" style="width:23em;height:12em;">
        <div class="card-header" style="background-color:yellow">
            ATTENDANCE <span class="small">(Entries last week)</span>

        </div>
        <div class="card-body collapse show">
            <p style="font-size:3em;" class="counter">{{$date_count}}</p>
        </div>
    </div>






@endsection