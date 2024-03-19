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


    <!-- calender ui jquery -->


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




    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

    <style>
       
    </style>


</head>

<body>
    <div class="container-scroller">

        <!-- partial:partials/_navbar.html -->
        @include('layouts.header')

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->

            @include('layouts.sidebar')
          
            <div class="main-panel">
            
                @yield('content')

               
                @include('layouts.footer')

                </a>
            </div><a href="" target="_new">
                <!-- main-panel ends -->
            </a>
        </div><a href="" target="_new">
            <!-- page-body-wrapper ends -->
        </a>
    </div><a href="" target="_new">
      
     
    <script src="{{asset('public/assets/js/hoverable-collapse.js')}}"></script>
        <script src="{{asset('public/assets/js/misc.js')}}"></script>
      
    </a>
</body>

</html>