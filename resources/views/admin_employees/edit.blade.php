@extends('layouts.AdminDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Update Employee</h4>
                </div>
                <div class="card-body">
                    <div class="row m-b-10">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'GET','action'=>'EmployeeController@index']) !!}
                            <div class="form-group">
                                {{Form::submit('Back',['class'=>'btn btn-warning float-right'])}}
                            </div>
                            {!! Form::close() !!}

                        </div>
                    </div>

                    {!! Form::model($employees,['method'=>'PATCH','action'=>['EmployeeController@update',$employees->id]]) !!}

                    <div class="form-group row">
                        <div class="col-sm-6">
                            {!! Form::label('name', 'Name:') !!}
                            {!! Form::text('name', null, ['class' => 'form-control','tabindex'=>1]) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::label('phone', 'Phone:') !!}
                            {!! Form::text('phone', null, ['class' => 'form-control','tabindex'=>7]) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            <div class="form-group m-l-15">
                                <label class="control-label">Gender</label>
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" name="gender" checked="" id="radio1" value="Male" tabindex="2">
                                            <label for="radio1">Male</label>
                                        </div>
                                    </label>
                                    <label class="radio-inline">
                                        <div class="radio radio-info">
                                            <input type="radio" name="gender" id="radio2" value="Female" tabindex="3">
                                            <label for="radio2">Female</label>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            {!! Form::label('date_of_birth', 'Date of Birth:') !!}
                            {!! Form::text('date_of_birth', null, ['class' => 'form-control','id'=>'datepicker1','placeholder'=>'yyyy-mm-dd','tabindex'=>8]) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            {!! Form::label('email', 'Email:') !!}
                            {!! Form::email('email', null, ['class' => 'form-control','tabindex'=>4]) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::label('address', 'Address:') !!}
                            {!! Form::text('address', null, ['class' => 'form-control','tabindex'=>9]) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            {!! Form::label('password', 'Password:') !!}
                            {!! Form::password('password',['class' => 'form-control','tabindex'=>5]) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::label('department_id', 'Department :') !!}
                            {!! Form::select('department_id',$departments,null, ['class' => 'form-control','tabindex'=>10]) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            {!! Form::label('password_confirmation', 'Confirm Password:') !!}
                            {!! Form::password('password_confirmation',['class' => 'form-control','tabindex'=>6]) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::label('position_id', 'Position :') !!}
                            {!! Form::select('position_id',$positions,null, ['class' => 'form-control','tabindex'=>11]) !!}
                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col-sm-2"></div>


                        <div class="col-sm-4">
                            {!! Form::submit('Update Employee',['class'=>'btn btn-success btn-block','tabindex'=>12]) !!}
                        </div>
                        <div class="col-sm-4">
                            {!! Form::reset('Cancel',['class'=>'btn btn-danger btn-block','tabindex'=>13]) !!}
                        </div>


                        <div class="col-sm-2"></div>


                    </div>
                    {!! Form::close() !!}
                    @include('includes.form_error')
                </div>
            </div>
        </div>
    </div>

@endsection