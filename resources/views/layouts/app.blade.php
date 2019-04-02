<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="images/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        SMART HR
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/material_style.css') }}" rel="stylesheet">

    <link href="{{ asset('css/material-kit.css?v=2.0.5') }}" rel="stylesheet">





</head>

<body class="landing-page sidebar-collapse">
<nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand " href="{{route('welcome_page')}}">
                SMART HR </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fa fa-user-o"></i> Login
                    </a>
                    <div class="dropdown-menu dropdown-with-icons">
                        <a href="{{route('admin.postLogin')}}" class="dropdown-item">
                            <i class="fa fa-lock">&nbsp;</i> Login as Admin
                        </a>
                        <a href="{{route('login')}}" class="dropdown-item">
                            <i class="fa fa-lock">&nbsp;</i> Login as Employee
                        </a>
                    </div>
                </li>


            </ul>
        </div>
    </div>
</nav>
<div class="page-header header-filter" data-parallax="true" style="background-image: url('../images/home_page.jpg')">
@yield('content')
</div>





<script src="{{ asset('js/material_script.js') }}"></script>

<script src="{{ asset('js/popper.min.js') }}"></script>

<script src="{{ asset('js/bootstrap-material-design.min.js') }}"></script>

<script src="{{ asset('js/nouislider.min.js') }}"></script>

<script src="{{ asset('js/material-kit.js?v=2.0.5') }}"></script>



</body>

</html>