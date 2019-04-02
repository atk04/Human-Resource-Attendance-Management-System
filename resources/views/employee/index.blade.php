@extends('layouts.EmployeeDashboard')



@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Attendance View</h4>
                </div>
                <div class="card-body">
                    <div class="row m-b-10">
                        <div class="col-md-12">
                            <p>Search attendance by Month</p>
                            {!! Form::open(['method'=>'GET','action'=>'EmployeeAttendanceViewController@search']) !!}
                            {{@csrf_field()}}
                            <div class="input-group mb-3">

                                <input type="text" name="search_month" id="datepicker7" class="form-control"
                                       placeholder="yyyy-mm"
                                       aria-label="search month" aria-describedby="basic-addon2">
                                <div class="input-group-append input-group-btn">

                                    <input type="submit" class="btn btn-warning input-group-btn py-3 px-4"
                                           value="Search">


                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-bordered">
                                <table class="table">
                                    <thead class="bg-light-inverse text-inverse">
                                    <tr class="text-center">
                                        <td>Name</td>
                                        <td>Code</td>
                                        <td>Attendance Date</td>
                                        <td>Time In</td>
                                        <td>Time Out</td>
                                        <td>Overtime Duration</td>
                                        <td>Undertime Duration</td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($attendances)>0)

                                        @foreach($attendances as $attendance)
                                            <tr>
                                                <td class="text-center">{{$employee->name}}</td>
                                                <td class="text-center">{{$employee->position_code}}</td>
                                                <td class="text-center">{{$attendance->date}}</td>
                                                <td class="text-center">{{$attendance->time_in}}</td>
                                                <td class="text-center">{{$attendance->time_out}}</td>
                                                <td class="text-center">{{$attendance->overtime_hour}}</td>
                                                <td class="text-center">{{$attendance->undertime_hour}}</td>


                                            </tr>

                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="7"
                                                class="text-center text-danger">{{"There is no attendance data"}}</td>
                                        </tr>
                                    @endif


                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 m-t-10">

                        <div class="form-group float-right">
                            {{$attendances->render()}}
                        </div>


                    </div>
                    <br><br>
                    <div class="col-md-12">
                        @include('includes.form_error')
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection