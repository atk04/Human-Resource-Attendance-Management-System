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
</head>

<body class="fix-header fix-sidebar card-no-border">
@include('includes.form_message')
<div id="main-wrapper">
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{route('home')}}">
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
                        <a class="nav-link btn btn-danger px-xl-4 py-0" href="{{route('user.logout')}}">Logout</a>

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

                    <li><a href="{{route('employee.attendance')}}"><i class="fa fa-bar-chart fa-2x"></i><span class="hide-menu">Attendance </span></a>
                    </li>
                    <li><a href="{{route('employee.leave')}}"><i class="fa fa-file-text fa-2x"></i><span
                                    class="hide-menu">Employee Leave </span></a></li>
                    <li><a href="{{route('employee.calendar')}}"><i class="fa fa-calendar-check-o fa-2x"></i><span
                                    class="hide-menu">Official Holiday </span></a></li>
                    <li><a href="{{route('employee.profile')}}"><i class="fa fa-user-circle-o fa-2x"></i><span class="hide-menu">Edit Profile</span></a>
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


<link href="{{ asset('css/zebra_datepicker.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/zebra_datepicker.min.js') }}"></script>


<script type="text/javascript">
    $(document).ready(function () {




        $('#datepicker5').Zebra_DatePicker({
            direction: true,
            disabled_dates: ['* * * 0,6']
        });
        $('#datepicker6').Zebra_DatePicker({
            direction: true,
            disabled_dates: ['* * * 0,6']
        });

        $('#datepicker7').Zebra_DatePicker({
            format: 'Y-m'
        });


    });

</script>



</body>

</html>