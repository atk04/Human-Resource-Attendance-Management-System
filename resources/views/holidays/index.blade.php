@extends('layouts.AdminDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Holiday Management</h4>
                </div>
                <div class="card-body">
                    <div class="row m-b-10">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'GET','action'=>'HolidayController@admin_calendar']) !!}
                            <div class="form-group d-inline m-2 float-right">
                                {{Form::submit('View Holiday List',['class'=>'btn btn-primary float-right'])}}
                            </div>
                            {!! Form::close() !!}


                            {!! Form::open(['method'=>'GET','action'=>'HolidayController@create']) !!}
                            <div class="form-group d-inline m-2 float-right">
                                {{Form::submit('Add Holiday',['class'=>'btn btn-warning float-right'])}}
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
                                        <td>Title</td>
                                        <td>Start Date</td>
                                        <td>End Date</td>
                                        <td colspan="2">Action</td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($holidays)>0)

                                        @foreach($holidays as $holiday)
                                            <tr>
                                                <td class="text-center">{{$holiday->title}}</td>
                                                <td class="text-center">{{$holiday->start_date}}</td>
                                                <td class="text-center">{{$holiday->end_date}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-warning btn-block"
                                                       href="{{route('holiday.edit',$holiday->id)}}">Update</a>
                                                </td>

                                                <td class="text-center">


                                                    {!! Form::open(['method'=>'DELETE','action'=>['HolidayController@destroy',$holiday->id]]) !!}
                                                    <div class="form-group">
                                                        {{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
                                                    </div>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>

                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="4"
                                                class="text-center text-danger">{{"There is no holidays"}}</td>
                                        </tr>
                                    @endif


                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 m-t-10">

                        <div class="form-group float-right">
                            {{$holidays->render()}}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection