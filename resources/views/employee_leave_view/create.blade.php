@extends('layouts.EmployeeDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Create Department</h4>
                </div>
                <div class="card-body">
                    <div class="row m-b-10">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'GET','action'=>'EmployeeLeaveViewController@index']) !!}
                            <div class="form-group">
                                {{Form::submit('Back',['class'=>'btn btn-warning float-right'])}}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    {!! Form::open(['method'=>'POST','action'=>'EmployeeLeaveViewController@store']) !!}

                    <div class="form-group">
                        {!! Form::label('start_date', 'Leave Start Date:') !!}
                        {!! Form::text('start_date', null, ['class' => 'form-control','id'=>'datepicker5']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('end_date', 'Leave End Date:') !!}
                        {!! Form::text('end_date', null, ['class' => 'form-control','id'=>'datepicker6']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('leave_type_id', 'Select Leave Type:') !!}
                        {!! Form::select('leave_type_id', [''=>'Select One']+$leave_types,null, ['class' => 'form-control ']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('submit_date', 'Submit Date:') !!}
                        {!! Form::text('submit_date', $submit_date, ['class' => 'form-control','disabled'=>'disabled']) !!}
                    </div>



                    <div class="form-group">
                        {!! Form::submit('Take Leave',['class'=>'btn btn-success']) !!}
                        {!! Form::reset('Cancel',['class'=>'btn btn-danger']) !!}
                    </div>

                    {!! Form::close() !!}
                    @include('includes.form_error')
                </div>
            </div>
        </div>
    </div>

@endsection