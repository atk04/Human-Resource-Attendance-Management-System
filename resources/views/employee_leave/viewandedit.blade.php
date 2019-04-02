@extends('layouts.AdminDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">

                <div class="card-body">
                    <div class="row m-b-10">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'GET','action'=>'EmployeeLeaveController@index']) !!}
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
                                        <td>Leave Type</td>
                                        <td>Start Date</td>
                                        <td>End Date</td>
                                        <td>Leave Days</td>
                                        <td>Remain Leave Days</td>
                                        <td>Submit Date</td>
                                        <td>Status</td>
                                        <td colspan="3">Action</td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($employee_leaves)>0)

                                        @foreach($employee_leaves as $employee_leave)
                                           @if($employee_leave->leave_status=="Pending")
                                           <?php $color="text-warning"; ?>
                                           @elseif($employee_leave->leave_status=="Reject")
                                              <?php $color="text-danger" ?>
                                           @elseif($employee_leave->leave_status=="Approve")
                                              <?php $color="text-success" ?>
                                           @endif
                                            <tr>
                                                <td class="text-center">{{$employee_leave->employee->name}}</td>
                                                <td class="text-center">{{$employee_leave->leaveType->name}}</td>
                                                <td class="text-center">{{$employee_leave->start_date}}</td>
                                                <td class="text-center">{{$employee_leave->end_date}}</td>
                                                <td class="text-center">{{$employee_leave->number_of_day}}</td>
                                                <td class="text-center">{{$employee_leave->remain_day}}</td>
                                                <td class="text-center">{{$employee_leave->submit_date}}</td>
                                                <td class="text-center {{$color}}">{{$employee_leave->leave_status}}</td>
                                                <td class="text-center">

                                                    {!! Form::open(['method'=>'POST','action'=>['EmployeeLeaveController@approve',$employee_leave->id]]) !!}
                                                    {!! Form::hidden('leave_status', "Approve", ['class' => 'form-control']) !!}
                                                    <div class="form-group">
                                                        {{Form::submit('Approve',['class'=>'btn btn-primary btn-block'])}}
                                                    </div>
                                                    {!! Form::close() !!}

                                                </td>
                                                <td class="text-center">
                                                    {!! Form::open(['method'=>'POST','action'=>['EmployeeLeaveController@reject',$employee_leave->id]]) !!}
                                                    {!! Form::hidden('leave_status', "Reject", ['class' => 'form-control']) !!}
                                                    <div class="form-group">
                                                        {{Form::submit('Reject',['class'=>'btn btn-warning btn-block'])}}
                                                    </div>
                                                    {!! Form::close() !!}
                                                </td>

                                                <td class="text-center">


                                                    {!! Form::open(['method'=>'DELETE','action'=>['EmployeeLeaveController@destroy',$employee_leave->id]]) !!}
                                                    <div class="form-group">
                                                        {{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
                                                    </div>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>

                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="9" class="text-center text-danger">{{"There is no employee for leave data."}}</td>
                                        </tr>
                                    @endif


                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 m-t-10">

                        <div class="form-group float-right">
                            {{$employee_leaves->render()}}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection