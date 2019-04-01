@extends('layouts.EmployeeDashboard')



@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> View Holiday List</h4>
                </div>
                <div class="card-body">



                    <div class="row">




                        <div class="col-md-12">
                            <div class="table-bordered">
                                <table class="table">
                                    <thead class="bg-light-inverse text-inverse">
                                    <tr class="text-center">
                                        <td>Title</td>
                                        <td>Start Date</td>
                                        <td>End Date</td>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($holidays)>0)

                                        @foreach($holidays as $holiday)
                                            <tr>
                                                <td class="text-center">{{$holiday->title}}</td>
                                                <td class="text-center">{{$holiday->start_date}}</td>
                                                <td class="text-center">{{$holiday->end_date}}</td>
                                            </tr>

                                        @endforeach

                                    @else
                                        <tr>
                                            <td colspan="3" class="text-center text-danger">{{"There is no holidays."}}</td>
                                        </tr>
                                    @endif


                                    </tbody>


                                </table>
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
    </div>

@endsection