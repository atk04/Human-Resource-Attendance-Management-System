@extends('layouts.AdminDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Schedule Management</h4>
                </div>
                <div class="card-body">
                    <div class="row m-b-10">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'GET','action'=>'ScheduleController@create']) !!}
                            <div class="form-group">
                                {{Form::submit('Add Schedule',['class'=>'btn btn-primary float-right'])}}
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
                                        <td>Department Name</td>
                                        <td>Start Time</td>
                                        <td>End Time</td>
                                        <td colspan="2">Action</td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($schedules)>0)

                                        @foreach($schedules as $schedule)
                                            <tr>
                                                <td class="text-center">{{$schedule->department->name}}</td>
                                                <td class="text-center">{{$schedule->start_time}}</td>
                                                <td class="text-center">{{$schedule->end_time}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-warning btn-block"
                                                       href="{{route('schedule.edit',$schedule->id)}}">Update</a>
                                                </td>

                                                <td class="text-center">


                                                    {!! Form::open(['method'=>'DELETE','action'=>['ScheduleController@destroy',$schedule->id]]) !!}
                                                    <div class="form-group">
                                                        {{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
                                                    </div>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>

                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center text-danger">{{"There is no schedule for department"}}</td>
                                        </tr>
                                    @endif


                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 m-t-10">

                        <div class="form-group float-right">
                            {{$schedules->render()}}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection