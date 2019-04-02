@extends('layouts.AdminDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Update Schedule</h4>
                </div>
                <div class="card-body">
                    <div class="row m-b-10">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'GET','action'=>'ScheduleController@index']) !!}
                            <div class="form-group">
                                {{Form::submit('Back',['class'=>'btn btn-warning float-right'])}}
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>

                    {!! Form::model($schedule,['method'=>'PATCH','action'=>['ScheduleController@update',$schedule->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('department_name', 'Department Name:') !!}
                        {!! Form::text('department_name', $department_name, ['class' => 'form-control','disabled'=>'disabled']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('start_time', 'Start Time:') !!}
                        {!! Form::text('start_time', null, ['class' => 'form-control','id'=>'timepicker2']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('end_time', 'End Time:') !!}
                        {!! Form::text('end_time', null, ['class' => 'form-control','id'=>'timepicker1']) !!}
                    </div>



                    <div class="form-group">
                        {!! Form::submit('Update Schedule',['class'=>'btn btn-info']) !!}

                    </div>

                    {!! Form::close() !!}
                    @include('includes.form_error')
                </div>
            </div>
        </div>
    </div>

@endsection