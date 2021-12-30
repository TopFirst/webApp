<!DOCTYPE html>
<html lang="zxx">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name', 'LAM Batam') }} @yield('title')</title>
    <!-- plugin css for this page -->
    <link
      rel="stylesheet"
      href="{{ url('app/vendors/mdi/css/materialdesignicons.min.css') }}"
    />
    <link rel="stylesheet" href="{{ url('app/vendors/aos/dist/aos.css/aos.css') }}" />

    <!-- End plugin css for this page -->
    <link rel="shortcut icon" href="{{ url('app/images/favicon.png') }}" />

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('app/css/style.css') }}">
    <!-- endinject -->
  </head>

  <body>
    <div class="container-scroller">
      <div class="main-panel">
        <!-- partial:partials/_navbar.html -->
        @include('partials/_navbar')
        <!-- partial -->

        <div class="content-wrapper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Login') }}</div>
            
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
            
                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
            
                                    <div class="form-group row mb-0">
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
        </div>
        <!-- main-panel ends -->
        <!-- container-scroller ends -->

        <footer>
            <div class="footer-top">
              <div class="container">
                {{-- <div class="row">
                  <div class="col-sm-5">
                    <img src="assets/images/logo.svg" class="footer-logo" alt="" />
                    <h5 class="font-weight-normal mt-4 mb-5">
                      Newspaper is your news, entertainment, music fashion website. We
                      provide you with the latest breaking news and videos straight from
                      the entertainment industry.
                    </h5>
                    <ul class="social-media mb-3">
                      <li>
                        <a href="#">
                          <i class="mdi mdi-facebook"></i>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="mdi mdi-youtube"></i>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="mdi mdi-twitter"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div> --}}
              </div>
            </div>
            <div class="footer-bottom">
              <div class="container">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="d-sm-flex justify-content-between align-items-center">
                      <div class="fs-14 font-weight-600">
                        © 2020 @ <a href="https://www.bootstrapdash.com/" target="_blank" class="text-white"> BootstrapDash</a>. All rights reserved.
                      </div>
                      <div class="fs-14 font-weight-600">
                        Handcrafted by <a href="https://www.bootstrapdash.com/" target="_blank" class="text-white">BootstrapDash</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </footer>

      </div>
    </div>
    <!-- inject:js -->
    <script src="{{ url('app/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <script src="{{ url('app/vendors/aos/dist/aos.js/aos.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- Custom js for this page-->
    <script src="{{ url('app/js/demo.js') }}"></script>
    <script src="{{ url('app/js/jquery.easeScroll.js') }}"></script>
    <!-- End custom js for this page-->

  </body>
</html>