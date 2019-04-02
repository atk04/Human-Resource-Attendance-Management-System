@extends('layouts.EmployeeDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Edit Profile</h4>
                </div>
                <div class="card-body">
                    {!! Form::open(['method'=>'POST','action'=>['EmployeeProfileController@update',$employee->id]]) !!}



                    <div class="form-group row">
                        <div class="col-sm-6">
                            {!! Form::label('name', 'Name:') !!}
                            {!! Form::text('name', $employee->name, ['class' => 'form-control','tabindex'=>1,'disabled'=>'disabled']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::label('email', 'Email:') !!}
                            {!! Form::text('email', $employee->email, ['class' => 'form-control','tabindex'=>4,'disabled'=>'disabled']) !!}
                        </div>
                    </div>



                    <div class="form-group row">
                        <div class="col-sm-6">
                            {!! Form::label('password', 'Password:') !!}
                            {!! Form::password('password',['class' => 'form-control','tabindex'=>2]) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::label('phone', 'Phone:') !!}
                            {!! Form::text('phone', $employee->phone, ['class' => 'form-control','tabindex'=>5]) !!}
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-sm-6">
                            {!! Form::label('password_confirmation', 'Confirm Password:') !!}
                            {!! Form::password('password_confirmation',['class' => 'form-control','tabindex'=>3]) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::label('address', 'Address:') !!}
                            {!! Form::text('address', $employee->address, ['class' => 'form-control','tabindex'=>6]) !!}
                        </div>

                    </div>









                    <div class="form-group row">
                        <div class="col-sm-2"></div>


                        <div class="col-sm-4">
                            {!! Form::submit('Update Profile',['class'=>'btn btn-success btn-block','tabindex'=>12]) !!}
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