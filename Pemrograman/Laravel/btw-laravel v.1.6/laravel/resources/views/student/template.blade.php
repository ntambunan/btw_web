<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Student Dashboard</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="{{asset('../bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->
    <!-- ===== Animation CSS ===== -->
    <link href="{{asset('../css/animate.css')}}" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="{{asset('../css/style.css')}}" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="{{asset('../css/colors/purple.css')}}" id="theme" rel="stylesheet">
    @yield('header')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="mini-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- ===== Top-Navigation ===== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="top-left-part">
                    <a class="logo" href="{{url('admin/dashboard')}}">
                        <b>
                            <img src="{{asset('../images/Page 18bekasi.png')}}" alt="home" style="max-height: 50px;"/>
                        </b>
                        <span>
                            <img src="{{asset('../plugins/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
                        </span>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li>
                        <a href="javascript:void(0)" class="sidebartoggler font-20 waves-effect waves-light"><i class="icon-arrow-left-circle"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- ===== Top-Navigation-End ===== -->
        <!-- ===== Left-Sidebar ===== -->
        <aside class="sidebar" role="navigation">
            <div class="scroll-sidebar">
                <div class="user-profile">
                    <div class="dropdown user-pro-body">
                        <div class="profile-image">
                            <img src="{{asset('../plugins/images/users/hanna.jpg')}}" alt="user-img" class="img-circle">
                            <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="badge badge-danger">
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li><a href="/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </div>
                        <p class="profile-text m-t-15 font-16"><a href="#">{{$user->email}}</a></p>
                        <p class="m-t-15 font-13 text-capitalize">{{$user->role}}</p>
                    </div>
                </div>
                @if (!isset($nav_custom))
                <nav class="sidebar-nav">
                    <ul id="side-menu">
                        <li>
                            <a href="{{url('student/dashboard')}}" aria-expanded="false"><i class="icon-home fa-fw"></i> <span class="hide-menu">  Beranda</span></a>
                        </li>
                        <li>
                            <a href="{{url('student/score')}}" aria-expanded="false"><i class="icon-trophy fa-fw"></i> <span class="hide-menu">  Cek Nilai</span></a>
                        </li>
                        <li>
                            <a href="{{url('student/edit')}}" aria-expanded="false"><i class="icon-settings fa-fw"></i> <span class="hide-menu">  Edit Akun</span></a>
                        </li>
                    </ul>
                </nav>
                @else
                <nav class="sidebar-nav">
                    <ul id="side-menu">
                        <li>
                            <a href="{{$nav_custom}}" aria-expanded="false"><i class="icon-arrow-left-circle fa-fw"></i> <span class="hide-menu">  Kembali</span></a>
                        </li>
                    </ul>
                </nav>
                @endif
            </div>
        </aside>
        <!-- ===== Left-Sidebar-End ===== -->
        @yield('content')
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- ==============================
        Required JS Files
    =============================== -->
    <!-- ===== jQuery ===== -->
    <script src="{{asset('../plugins/components/jquery/dist/jquery.min.js')}}"></script>
    <!-- ===== Bootstrap JavaScript ===== -->
    <script src="{{asset('../bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- ===== Slimscroll JavaScript ===== -->
    <script src="{{asset('../js/jquery.slimscroll.js')}}"></script>
    <!-- ===== Wave Effects JavaScript ===== -->
    <script src="{{asset('../js/waves.js')}}"></script>
    <!-- ===== Menu Plugin JavaScript ===== -->
    <script src="{{asset('../js/sidebarmenu.js')}}"></script>
    <!-- ===== Custom JavaScript ===== -->
    <script src="{{asset('../js/custom.js')}}"></script>
    <!-- ===== Plugin JS ===== -->
    <!-- ===== Style Switcher JS ===== -->
    <script src="{{asset('../plugins/components/styleswitcher/jQuery.style.switcher.js')}}"></script>
    @yield('script')
</body>

</html>
