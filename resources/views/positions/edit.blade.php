@extends('layouts.AdminDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Update Position</h4>
                </div>
                <div class="card-body">
                    <div class="row m-b-10">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'GET','action'=>'PositionController@index']) !!}
                            <div class="form-group">
                                {{Form::submit('Back',['class'=>'btn btn-warning float-right'])}}
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>

                    {!! Form::model($position,['method'=>'PATCH','action'=>['PositionController@update',$position->id]]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Position Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>


                    <div class="form-group">
                        {!! Form::submit('Update Position',['class'=>'btn btn-info']) !!}

                    </div>

                    {!! Form::close() !!}
                    @include('includes.form_error')
                </div>
            </div>
        </div>
    </div>

@endsection