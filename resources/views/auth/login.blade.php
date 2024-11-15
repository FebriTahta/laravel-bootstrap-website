{{-- @extends('layouts.app')

@section('content')
<div class="container">
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
</div>
@endsection --}}

<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
  <title>
    Login To Admin Panel
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  {{-- <link id="pagestyle" href="{{asset('assets/css/argon-dashboard.css')}}" rel="stylesheet" /> --}}
  <link id="pagestyle" href="{{asset('assets/css/soft-ui-dashboard.css?v=1.0.7')}}" rel="stylesheet" />
</head>
  <body class="">
    <div class="container position-sticky z-index-sticky top-0">
      <div class="row">
        <div class="col-12">
          <!-- Navbar -->
          <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
            <div class="container-fluid pe-0">
              <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="#">
                Login To Admin Panel
              </a>
              <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
              </button>
              <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
                  <li class="nav-item">
                    {{-- <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="#">
                      <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                      Dashboard
                    </a> --}}
                  </li>
                  <li class="nav-item">
                    {{-- <a class="nav-link me-2" href="#">
                      <i class="fa fa-user opacity-6 text-dark me-1"></i>
                      Profile
                    </a> --}}
                  </li>
                  <li class="nav-item">
                    {{-- <a class="nav-link me-2" href="#">
                      <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                      Sign Up
                    </a> --}}
                  </li>
                  <li class="nav-item">
                    {{-- <a class="nav-link me-2" href="#">
                      <i class="fas fa-key opacity-6 text-dark me-1"></i>
                      Sign In
                    </a> --}}
                  </li>
                </ul>
                <li class="nav-item d-flex align-items-center">
                  <a class="btn btn-round btn-sm mb-0 btn-outline-primary me-2" target="_blank" href="#">Contact Dev</a>
                </li>
                {{-- <ul class="navbar-nav d-lg-block d-none">
                  <li class="nav-item">
                    <a href="#" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-dark">Free To Use</a>
                  </li>
                </ul> --}}
              </div>
            </div>
          </nav>
          <!-- End Navbar -->
        </div>
      </div>
    </div>
    <main class="main-content  mt-0">
      <section>
        <div class="page-header min-vh-100">
          <div class="container">
            <div class="row">
              <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                <div class="card card-plain mt-8">
                  <div class="card-header pb-0 text-left bg-transparent">
                    <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                    <p class="mb-0">Enter your Username and Password to sign in</p>
                  </div>
                  <div class="card-body">
                    <form role="form" id="formadd">@csrf
                      <div class="mb-3">
                        <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Username" aria-label="Username" required>
                      </div>
                      <div class="mb-3">
                        <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" required>
                      </div>
                      <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                      <div class="text-center">
                          <input type="submit" id="btnadd" class="btn bg-gradient-info w-100 mt-4 mb-0" value="Sign in">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                  <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  <!-- Toast -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <!--   Core JS Files   -->
  <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  {{-- <script src="{{asset('assets/js/argon-dashboard.min.js?v=2.0.4')}}"></script> --}}
  <script src="{{asset('assets/js/soft-ui-dashboard.min.js?v=1.0.7')}}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $('.guest').click(function () {
        swal({
            title: "SORRY",
            text: "You are not authenticated!",
            type: "error",
            timer: 2000,
        });
    })

    $('#formadd').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: "login",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#btnadd').attr('disabled', 'disabled');
                $('#btnadd').val('Process...');
            },
            success: function(response) {
              console.log('a');
                if (response.status == 200) {
                    $("#formadd")[0].reset();
                    $('#btnadd').val('Sign In');
                    $('#btnadd').attr('disabled', false);
                    swal({
                        title: "Hello!",
                        text: response.message,
                        type: "success",
                        timer: 3000,
                    }).then(okay => {
                        if (okay) {
                            window.location.href = response.link;
                        }else{
                            window.location.href = response.link;
                        }
                    });
                } else {
                    $('#btnadd').val('Sign In');
                    $('#btnadd').attr('disabled', false);
                    swal({
                        title: "Sorry!",
                        text: response.message,
                        type: "error",
                        timer: 2000
                    });
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
  </script>
</body>

</html>
