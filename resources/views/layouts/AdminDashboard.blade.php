<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <title>Human Resource Attendance Management System</title>

    <link href="{{ asset('css/fullcalendar.min.css') }}" rel="stylesheet">


    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/material_style.css') }}" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


    <![endif]-->

    <script src="{{ asset('js/modernizr.custom.80028.js') }}"></script>


    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pignose.calendar.min.css') }}" rel="stylesheet">









</head>

<body class="fix-header fix-sidebar card-no-border">
@include('includes.form_message')

<div id="main-wrapper">
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{route('admin.dashboard')}}">
                    <i class="fa fa-bar-chart"></i><span class="hide-menu">SMART HR </span>
                </a>
            </div>

            <div class="navbar-collapse">
                <ul class="navbar-nav mr-auto mt-md-0">
                    <li class="nav-item"><a class="nav-link nav-toggler hidden-md-up text-muted"
                                            href="javascript:void(0)"><i class="navbar-toggler-icon p-3"
                                                                         style="border:1px solid lightgrey;border-radius:5px;"></i></a>
                    </li>
                    <li class="nav-item"><a class="nav-link sidebartoggler hidden-sm-down text-muted"
                                            href="javascript:void(0)"><i class="navbar-toggler-icon p-3"
                                                                         style="border:1px solid lightgrey;border-radius:5px;"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <span class="navbar-text m-r-10 text-white">{{ "Hello ".Auth::user()->name }}</span>
                    </li>
                </ul>
                <ul class="navbar-nav my-lg-0">

                    <li class="nav-item">
                        <a class="nav-link btn btn-danger px-xl-4 py-0" href="{{route('admin.logout')}}">Logout</a>

                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">

            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard fa-2x"></i><span
                                    class="hide-menu">Dashboard </span></a></li>
                    <li class=""><a href="{{route('department.index')}}"><i class="fa fa-home fa-2x"></i><span
                                    class="hide-menu">Department </span></a>
                    </li>
                    <li><a href="{{route('schedule.index')}}"><i class="fa fa-calendar fa-2x"></i><span
                                    class="hide-menu">Schedule </span></a></li>
                    <li><a href="{{route('position.index')}}"><i class="fa fa-sitemap fa-2x"></i><span
                                    class="hide-menu">Position </span></a></li>
                    <li><a href="{{route('employee.index')}}"><i class="fa fa-user-circle fa-2x"></i><span
                                    class="hide-menu">Employee </span></a>
                    </li>
                    <li><a href="{{route('attendance.index')}}"><i class="fa fa-bar-chart fa-2x"></i><span
                                    class="hide-menu">Attendance </span></a>
                    </li>
                    <li><a href="{{route('employeeleave.index')}}"><i class="fa fa-file-text fa-2x"></i><span
                                    class="hide-menu">Employee Leave </span></a></li>
                    <li><a href="{{route('leave_type.index')}}"><i class="fa fa-list fa-2x"></i><span class="hide-menu">Leave Type </span></a>
                    </li>
                    <li><a href="{{route('holiday.index')}}"><i class="fa fa-calendar-check-o fa-2x"></i><span
                                    class="hide-menu">Official Holiday </span></a></li>
                    <li><a href="{{route('report.index')}}"><i class="fa fa-print fa-2x"></i><span class="hide-menu">Report</span></a>
                    </li>


                </ul>
            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->

    </aside>

    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row p-t-20">
                @yield('content')
            </div>


        </div>


        <footer class="footer text-right">
            <script type="text/javascript">
                var d = new Date();
                var year = d.getFullYear();
                var pre_year = year - 1;
                document.write(pre_year);</script>
            -
            <script>
                document.write(year);</script>
            <strong>Copyright</strong> &copy;

            by Aung Thein Kyaw
        </footer>

    </div>

</div>


<script src="{{ asset('js/material_script.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script src="{{ asset('js/jquery.waypoints.js') }}"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
<!-- Scripts -->

<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/fullcalendar.min.js') }}"></script>


<link href="{{ asset('css/zebra_datepicker.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/zebra_datepicker.min.js') }}"></script>

<link href="{{ asset('css/mdtimepicker.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/mdtimepicker.min.js') }}"></script>


<!-- jQuery peity -->
<script src="{{ asset('js/jquery.peity.min.js') }}"></script>
<script src="{{ asset('js/jquery.peity.init.js') }}"></script>

<script src="{{ asset('js/pignose.calendar.full.min.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $('#timepicker1').mdtimepicker();
        $('#timepicker2').mdtimepicker();
        $('#timepicker3').mdtimepicker();
        $('#timepicker4').mdtimepicker();

        $('#datepicker1').Zebra_DatePicker({
            view: 'years',
            direction: false
        });

        $('#datepicker2').Zebra_DatePicker({
            direction: true,
            disabled_dates: ['* * * 0,6']
        });
        $('#datepicker3').Zebra_DatePicker({
            direction: true,
            disabled_dates: ['* * * 0,6']
        });
        $('#datepicker4').Zebra_DatePicker({
            direction: false,
            disabled_dates: ['* * * 0,6']
        });

    });

</script>

<script>
    $(document).ready(function () {
        $('#position_code').keyup(function () {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('admin.attendance.fetch')}}",
                    method: "POST",
                    data: {query: query, _token: _token},
                    success: function (data) {
                        $('#position_code_list').fadeIn();
                        $('#position_code_list').html(data);
                    }
                })
            }
        });
        $(document).on('click', 'li.attendance', function () {
            $('#position_code').val($(this).text());
            $('#position_code_list').fadeOut();
        });
    });


    $(document).ready(function () {
        $('#position_code2').keyup(function () {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('admin.leave.fetch')}}",
                    method: "POST",
                    data: {query: query, _token: _token},
                    success: function (data) {
                        $('#position_code_list2').fadeIn();
                        $('#position_code_list2').html(data);
                    }
                })
            }
        });
        $(document).on('click', 'li.leave', function () {
            $('#position_code2').val($(this).text());
            $('#position_code_list2').fadeOut();
        });
    });
</script>


<script>

    $(".counter").counterUp({
        delay: 100,
        time: 1200
    });</script>

<script>


    $(function () {


        $('#wrapper .version strong').text('v' + $.fn.pignoseCalendar.version);


        function onApplyHandler(date, context) {
            /**
             * @date is an array which be included dates(clicked date at first index)
             * @context is an object which stored calendar interal data.
             * @context.calendar is a root element reference.
             * @context.calendar is a calendar element reference.
             * @context.storage.activeDates is all toggled data, If you use toggle type calendar.
             * @context.storage.events is all events associated to this date
             */

            var $element = context.element;
            var $calendar = context.calendar;
            var $box = $element.siblings('.box').show();
            var text = 'You applied date ';

            if (date[0] !== null) {
                text += date[0].format('YYYY-MM-DD');
            }

            if (date[0] !== null && date[1] !== null) {
                text += ' to ';
            } else if (date[0] === null && date[1] == null) {
                text += 'nothing';
            }

            if (date[1] !== null) {
                text += date[1].format('YYYY-MM-DD');
            }

            $box.text(text);
        }

        $('.input-calendar1').pignoseCalendar({
            theme: 'blue', // light, dark, blue
            format: 'YYYY-MM-DD',
            pickWeeks: true,
            multiple: true,
            apply: onApplyHandler,
            buttons: true

        });
        $('.input-calendar2').pignoseCalendar({
            theme: 'blue', // light, dark, blue
            format: 'YYYY-MM-DD',
            pickWeeks: true,
            multiple: true,
            apply: onApplyHandler,
            buttons: true

        });


    });


</script>







</body>

</html>