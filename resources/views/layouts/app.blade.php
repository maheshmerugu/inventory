<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inventory Management System</title>
    <!-- plugins:css -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('public/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <!-- <link rel="stylesheet" href="public/assets/vendors/css/vendor.bundle.base.css"> -->

    <link rel="stylesheet" href="{{asset('public/assets/vendors/css/vendor.bundle.base.css')}}">




    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.png')}}" />



    <link rel="stylesheet" href="{{asset('public/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.png')}}" />



    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('public/assets/vendors/js/vendor.bundle.base.js')}}" type="text/javascript"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('public/assets/js/jquery.cookie.js')}}" type="text/javascript"></script>

    <script src="{{asset('public/assets/vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('public/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('public/assets/js/misc.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/js/dashboard.js')}}"></script>
    <script src="{{asset('public/assets/js/todolist.js')}}"></script>


    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('public/assets/js/hoverable-collapse.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>


</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="index.php"><img src="{{asset('public/images/logo.png')}}" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini" href="index.php"><img src="{{asset('public/images/logo-mini.png')}}" alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <div class=" logo-text mt-4">
                    <h4>Welcome to Inventory Management System</h4>
                </div>
                <ul class="navbar-nav navbar-nav-right">


                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-account me-2"></i> Users
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                            <h6 class="p-2 mb-0"></h6>
                            <h6 class="p-2 mb-0"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"> <i class="mdi mdi-power   me-2"></i>Logout</a></h6>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->


        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">

                    <li class="nav-item ">
                        <a class="nav-link" href="index.php">
                            <span class="menu-title"> <i class="mdi mdi-home menu-icon f2"></i> &nbsp; Dashboard</span>
                            <i class="mdi mdi-home menu-icon f1"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="#ui-basics" aria-expanded="false" aria-controls="ui-basics">
                            <span class="menu-title"> <i class="mdi mdi-database f2"></i> &nbsp; Masters</span>
                            <i class="mdi mdi-database menu-icon f1"></i> <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basics" style="">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{route('users.master')}}">Create Users</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('item-groups')}}">Item Group</a></li>
                                <li class="nav-item"> <a class="nav-link" href="item-master.php">Item Master</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('vendor.master')}}">Vendor Master</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('location.master')}}">Location Master</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('employee.master')}}">Employee Master</a></li>
                                <li class="nav-item"> <a class="nav-link" href="amc-master.php">Po/ Amc master</a></li>
                                <li class="nav-item"> <a class="nav-link" href="section.php">Section</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('district.master')}}">District</a></li>
                                <li class="nav-item"> <a class="nav-link" href="{{route('courts.master.list')}}">Courts</a></li>

                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="store-receipt.php">
                            <span class="menu-title"> <i class="mdi mdi-receipt  menu-icon f2"></i> &nbsp; Store Receipt</span>
                            </span>
                            <i class="mdi mdi-receipt  menu-icon f1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="issue-form.php">
                            <span class="menu-title"> <i class="mdi mdi-file-document-box menu-icon f2"></i> &nbsp; Issue Form</span>
                            </span>
                            <i class="mdi mdi-file-document-box menu-icon f1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="return-form.php">
                            <span class="menu-title"> <i class="mdi mdi-file-multiple  menu-icon f2"></i> &nbsp; Return Form</span>
                            </span>
                            <i class="mdi mdi-file-multiple menu-icon f1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="menu-title"> <i class="mdi mdi-file-send  menu-icon f2"></i> &nbsp; By Back / Transfer Form</span>
                            </span>
                            <i class="mdi mdi-file-send  menu-icon f1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="menu-title"> <i class="mdi mdi-magnify  menu-icon f2"></i> &nbsp; Query</span>
                            </span>
                            <i class="mdi mdi-magnify menu-icon f1"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="menu-title"> <i class="mdi mdi-receipt  menu-icon f2"></i> &nbsp; Reports</span>
                            <i class="mdi mdi-receipt menu-icon f1"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('user.password.change')}}">
                            <span class="menu-title"> <i class="mdi mdi-lock menu-icon f2"></i> &nbsp; Change Password</span>
                            <i class="mdi mdi-lock menu-icon f1"></i>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <span class="menu-title"> <i class="mdi mdi-power menu-icon f2"></i> &nbsp; Logout</span>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            <i class="mdi mdi-power menu-icon f1"></i>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="main-panel">
                @yield('content')
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <p>© Copyright 2024. Inventory Management System, All Rights Reserved. </p>
                </div>
                <div class="col-lg-6 text-end">
                    <p>Developed By <a href="" target="_new">Richlabz</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- End custom js for this page -->

</body>

</html>