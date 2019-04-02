@extends('layouts.AdminDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Add Attendance</h4>
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
                    {!! Form::open(['method'=>'POST','action'=>'AttendanceController@store']) !!}
                    {!! Form::hidden('employee_id', $employee->id) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Employee Name:') !!}
                        {!! Form::text('name', $employee->name, ['class' => 'form-control','disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('code', 'Code:') !!}
                        {!! Form::text('code', $employee->position_code, ['class' => 'form-control','disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('date', 'Attendance Date:') !!}
                        {!! Form::text('date', null, ['class' => 'form-control','id'=>'datepicker4']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('time_in', 'Time In:') !!}
                        {!! Form::text('time_in', null, ['class' => 'form-control','id'=>'timepicker3']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('time_out', 'Time Out:') !!}
                        {!! Form::text('time_out', null, ['class' => 'form-control','id'=>'timepicker4']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Add Attendance',['class'=>'btn btn-success']) !!}
                        {!! Form::reset('Cancel',['class'=>'btn btn-danger']) !!}
                    </div>

                    {!! Form::close() !!}
                    @include('includes.form_error')
                </div>
            </div>
        </div>
    </div>

@endsection