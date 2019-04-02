@extends('layouts.AdminDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Employee Management</h4>
                </div>
                <div class="card-body">
                    <div class="row m-b-10">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'GET','action'=>'EmployeeController@create']) !!}
                            <div class="form-group">
                                {{Form::submit('Add Employee',['class'=>'btn btn-primary float-right'])}}
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
                                        <td>Email</td>
                                        <td>Employee Code</td>
                                        <td>Department</td>
                                        <td>Position</td>
                                        <td colspan="2">Action</td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($employees)>0)

                                        @foreach($employees as $employee)
                                            <tr>
                                                <td class="text-center">{{$employee->name}}</td>
                                                <td class="text-center">{{$employee->email}}</td>
                                                <td class="text-center">{{$employee->position_code}}</td>
                                                <td class="text-center">{{$employee->department->name}}</td>
                                                <td class="text-center">{{$employee->position->name}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-warning btn-block"
                                                       href="{{route('employee.edit',$employee->id)}}">Update</a>
                                                </td>

                                                <td class="text-center">


                                                    {!! Form::open(['method'=>'DELETE','action'=>['EmployeeController@destroy',$employee->id]]) !!}
                                                    <div class="form-group">
                                                        {{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
                                                    </div>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>

                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center text-danger">{{"There is no employee"}}</td>
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