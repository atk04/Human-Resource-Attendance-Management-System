@extends('layouts.EmployeeDashboard')



@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Leave View</h4>
                </div>
                <div class="card-body">
                    <div class="row m-b-10">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'GET','action'=>'EmployeeLeaveViewController@create']) !!}
                            <div class="form-group">
                                {{Form::submit('Take Leave',['class'=>'btn btn-primary float-right'])}}
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
                                        <td>Leave Type</td>
                                        <td>Start Date</td>
                                        <td>End Date</td>
                                        <td>Leave Days</td>
                                        <td>Remain Leave Days</td>
                                        <td>Submit Date</td>
                                        <td>Leave Status</td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($employee_leaves)>0)


                                        @foreach($employee_leaves as $employee_leave)

                                                @if($employee_leave->leave_status=="Pending")
                                                    <?php $color="text-warning" ?>
                                                @elseif($employee_leave->leave_status=="Reject")
                                                    <?php $color="text-danger" ?>
                                                @elseif($employee_leave->leave_status=="Approve")
                                                    <?php $color="text-success" ?>
                                                @endif

                                            <tr>
                                                <td class="text-center">{{$employee_leave->LeaveType->name}}</td>
                                                <td class="text-center">{{$employee_leave->start_date}}</td>
                                                <td class="text-center">{{$employee_leave->end_date}}</td>
                                                <td class="text-center">{{$employee_leave->number_of_day}}</td>
                                                <td class="text-center">{{$employee_leave->remain_day}}</td>
                                                <td class="text-center">{{$employee_leave->submit_date}}</td>
                                                <td class="text-center {{$color}}">{{$employee_leave->leave_status}}</td>




                                            </tr>

                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="7"
                                                class="text-center text-danger">{{"There is no leave data"}}</td>
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