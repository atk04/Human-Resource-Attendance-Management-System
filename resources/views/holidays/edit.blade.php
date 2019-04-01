@extends('layouts.AdminDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Update Holiday</h4>
                </div>
                <div class="card-body">
                    <div class="row m-b-10">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'GET','action'=>'HolidayController@index']) !!}
                            <div class="form-group">
                                {{Form::submit('Back',['class'=>'btn btn-warning float-right'])}}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    {!! Form::model($holiday,['method'=>'PATCH','action'=>['HolidayController@update',$holiday->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('title', 'Title:') !!}
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('start_date', 'Start Date:') !!}
                        {!! Form::text('start_date', null, ['class' => 'form-control','disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('end_date', 'Start Date:') !!}
                        {!! Form::text('end_date', null, ['class' => 'form-control','disabled'=>'disabled']) !!}
                    </div>



                    <div class="form-group">
                        {!! Form::submit('Update Holiday',['class'=>'btn btn-success']) !!}
                        {!! Form::reset('Cancel',['class'=>'btn btn-danger']) !!}
                    </div>

                    {!! Form::close() !!}
                    @include('includes.form_error')
                </div>
            </div>
        </div>
    </div>

@endsection