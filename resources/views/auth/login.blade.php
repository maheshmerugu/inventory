
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Admin</title>
    <!-- plugins:css -->


    <link rel="stylesheet" href="{{asset('public/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('public/assets/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

  <link rel="stylesheet" href="{{asset('public/assets/css/style.css')}}">

  <link rel="stylesheet"   href="{{asset('public/vendors/css/vendor.bundle.base.css')}}">

  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        body {
            background-image: url(public/images/login.png);
            width: 100%;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            background-repeat: no-repeat;
            /* overflow-y: hidden; */
        }

        .content-wrapper {
            background: transparent;

            width: 100%;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }

        input[type=radio] {
            width: 13px;
            height: 13px;
        }
    </style>
</head>

<body>
    <div class="container-scrollers">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-sm-4"></div>
                    <div class="col-lg-4 ">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo text-center pb-3">


                                <img src="{{ asset('public/images/main-logo.png') }}" alt="Example Image">




                            </div>

                            <p class="text-center">The Brand you can trust!</p>
                            <form class="pt-3" method="POST" action="{{ route('login') }}">
                                @csrf

                            <div class="form-group">
                                    <label for="exampleInputUsername1">Email ID Or Phone Number</label>
                                    <input id="email" type="email"  type="text" name="email"      class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" id="exampleInputUsername1"
                                        placeholder="Enter your Email ID"> <i class="mdi mdi-email "></i>



                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Password</label>
                                    <input id="password" type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        id="exampleInputPassword1" placeholder="Password"><i
                                        class="mdi mdi-lock menu-icon "></i>


                                </div>

                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="otp">
                                        <!-- <span class="text-danger">OTP</span> &nbsp;
                                        <input type="radio" id="html" name="fav_language" value="HTML">
                                        <label for="html">SMS</label>&nbsp; <input type="radio" id="html"
                                            name="fav_language" value="HTML">
                                        <label for="html">Email</label> -->
                                    </div>
                                    <a href="#" class="auth-link text-black">Forgot password?</a>
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-gradient-info btn-lg font-weight-medium auth-form-btn" type="submit">LOGIN</button>
                                </div>
                                <!-- <div class="text-center mt-4 font-weight-light text-secondary">
                                    <p> Follow us on </p>

                                    <i class="mdi mdi-facebook"></i> &nbsp; <i class=" mdi mdi-twitter "></i>
                                    &nbsp;<i class=" mdi mdi-linkedin"></i> &nbsp;<i class=" mdi mdi-instagram"></i>

                                </div> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('public/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('public/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('public/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('public/assets/js/misc.js')}}"></script>
    <!-- endinject -->
</body>

</html>



<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->