@extends('layouts.AdminDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Position Management</h4>
                </div>
                <div class="card-body">
                    <div class="row m-b-10">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'GET','action'=>'PositionController@create']) !!}
                            <div class="form-group">
                                {{Form::submit('Add Position',['class'=>'btn btn-primary float-right'])}}
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
                                        <td>Code</td>
                                        <td>Name</td>
                                        <td colspan="2">Action</td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($positions)>0)

                                        @foreach($positions as $position)
                                            <tr>
                                                <td class="text-center">{{$position->code}}</td>
                                                <td class="text-center">{{$position->name}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-warning btn-block"
                                                       href="{{route('position.edit',$position->id)}}">Update</a>
                                                </td>

                                                <td class="text-center">


                                                    {!! Form::open(['method'=>'DELETE','action'=>['PositionController@destroy',$position->id]]) !!}
                                                    <div class="form-group">
                                                        {{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
                                                    </div>
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>

                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center text-danger">{{"There is no position for employee"}}</td>
                                        </tr>
                                    @endif


                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 m-t-10">

                        <div class="form-group float-right">
                            {{$positions->render()}}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection