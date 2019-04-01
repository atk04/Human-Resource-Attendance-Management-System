@extends('layouts.AdminDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Attendance Management</h4>
                </div>
                <div class="card-body">
                    <div class="row m-b-10">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'GET','action'=>'AttendanceController@index']) !!}
                            <div class="form-group">
                                {{Form::submit('Back',['class'=>'btn btn-warning float-right'])}}
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
                                        <td>Date</td>
                                        <td>Time In</td>
                                        <td>Time Out</td>
                                        <td>Overtime</td>
                                        <td>Undertime</td>
                                        <td colspan="2">Action</td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($attendances)>0)

                                        @foreach($attendances as $attendance)
                                            <tr>
                                                <td class="text-center">{{$attendance->date}}</td>
                                                <td class="text-center">{{$attendance->time_in}}</td>
                                                <td class="text-center">{{$attendance->time_out}}</td>
                                                <td class="text-center">{{$attendance->overtime_hour}}</td>
                                                <td class="text-center">{{$attendance->undertime_hour}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-warning btn-block"
                                                       href="{{route('attendance.edit',$attendance->id)}}">Update</a>
                                                </td>

                                                <td class="text-center">


                                                    {!! Form::open(['method'=>'DELETE','action'=>['AttendanceController@destroy',$attendance->id]]) !!}
                                                    <div class="form-group">
                                                        {{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
                                                    </div>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>

                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="7" class="text-center text-danger">{{"There is no attendance data."}}</td>
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
                </div>
            </div>
        </div>
    </div>

@endsection