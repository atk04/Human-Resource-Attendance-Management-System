@extends('layouts.AdminDashboard')
@section('content')
    <div class="row 0">
        <div class="container-fluid col-md-12">
            <div class="card card-outline-success" style="width:81vw;">
                <div class="card-header">
                    <h4 class="m-b-0 text-white"> Report Management</h4>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-bordered">
                                <table class="table">
                                    <thead class="bg-light-inverse text-inverse">
                                    <tr class="text-center">
                                        <td>Report Name</td>
                                        <td>Department Name</td>
                                        <td>Report Date</td>
                                        <td colspan="2">Action</td>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td style="font-weight: bold;font-size: 1em;"><span class="report_label1">Weekly Employee Attendance Report</span>
                                        </td>
                                        {!! Form::open(['method'=>'POST','action'=>'ReportController@downloadAttendance']) !!}
                                        <td>
                                            {!! Form::select('department_id', [''=>'Choose Department Name']+$departments,null, ['class' => 'form-control']) !!}
                                        </td>
                                        <td>
                                            <div class="input-group" id="leave_error1">
                                                <div class="input-group-addon"><span class="fa fa-calendar "></span>
                                                </div>
                                                <input type="text" placeholder="Enter date range" name="attendance_days"
                                                       class="input-calendar1 form-control">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                {!! Form::submit('Download',['class'=>'btn btn-primary']) !!}
                                            </div>

                                        </td>
                                        {!! Form::close() !!}

                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;font-size: 1em;"><span class="report_label2">Weekly Employee Leave Report</span>
                                        </td>
                                        {!! Form::open(['method'=>'POST','action'=>'ReportController@downloadLeave']) !!}
                                        <td>
                                            {!! Form::select('department_id', [''=>'Choose Department Name']+$departments,null, ['class' => 'form-control ']) !!}
                                        </td>
                                        <td>
                                            <div class="input-group" id="leave_error1">
                                                <div class="input-group-addon"><span class="fa fa-calendar "></span>
                                                </div>
                                                <input type="text" placeholder="Enter date range" name="leave_days"
                                                       class="input-calendar2 form-control">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                {!! Form::submit('Download',['class'=>'btn btn-primary']) !!}
                                            </div>

                                        </td>
                                        {!! Form::close() !!}

                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;font-size: 1em;"><span class="report_label3">Yearly Attend Three Employee Report</span>
                                        </td>
                                        {!! Form::open(['method'=>'POST','action'=>'ReportController@downloadYearlyAttend']) !!}
                                        <td>
                                            {!! Form::select('department_id', [''=>'Choose Department Name']+$departments,null, ['class' => 'form-control ']) !!}
                                        </td>
                                        <td>

                                            <select  name="year" class="form-control">
                                                <option selected disabled class="hideoption">Select Year</option>
                                                <?php
                                                $current_year = date('Y');
                                                $range = range($current_year, $current_year - 11);
                                                $year_count = count($range);
                                                for ($i = 0; $i < $year_count; $i++) {
                                                ?>
                                                <option value="<?php echo $range[$i]; ?>"><?php echo $range[$i]; ?></option>
                                                <?php } ?>
                                            </select>
                                            {{--{!! Form::select('year', [''=>'Select Year']+$range,null, ['class' => 'form-control ']) !!}--}}
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                {!! Form::submit('Download',['class'=>'btn btn-primary']) !!}
                                            </div>

                                        </td>
                                        {!! Form::close() !!}
                                        @include('includes.form_error')

                                    </tr>

                                    </tbody>


                                </table>
                            </div>
                            <br>

                        </div>


                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection