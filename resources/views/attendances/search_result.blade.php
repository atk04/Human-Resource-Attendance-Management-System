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
                                        <td>Name</td>
                                        <td>Code</td>
                                        <td colspan="2">Action</td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($employees)>0)

                                        @foreach($employees as $employee)
                                            <tr>
                                                <td class="text-center">{{$employee->name}}</td>
                                                <td class="text-center">{{$employee->position_code}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-primary btn-block"
                                                       href="{{route('attendance.show',$employee->id)}}">Add Attendance</a>
                                                </td>




                                                <td class="text-center">
                                                    <a class="btn btn-warning btn-block"
                                                       href="{{route('attendance.view_and_edit',$employee->id)}}">View and Edit Attendance</a>

                                                </td>
                                            </tr>

                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center text-danger">{{"There is no employee for attendance data."}}</td>
                                        </tr>
                                    @endif


                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 m-t-10">

                        <div class="form-group float-right">
                            {{$employees->render()}}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection