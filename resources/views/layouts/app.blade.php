<!DOCTYPE html>
<html lang="zxx">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    {{-- <title>{{ config('app.name', 'LAM Batam') }} @yield('title')</title> --}}
    <title>{{ config('app.name', 'LAM Batam') }} | {{ ucfirst($title??'') }}</title>
    <!-- plugin css for this page -->
    <link
      rel="stylesheet"
      href="{{ url('app/vendors/mdi/css/materialdesignicons.min.css') }}"
    />
    {{-- <link rel="stylesheet" href="{{ url('app/vendors/aos/dist/aos.css/aos.css') }}" /> --}}

    <!-- End plugin css for this page -->
    <link rel="shortcut icon" href="{{ url('app/images/favicon.png') }}" />

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('app/css/style.css') }}">
    <!-- endinject -->
  @stack('css')

  </head>

  <body>
    <div class="container-scroller">
      <div class="main-panel">
        <!-- partial:partials/_navbar.html -->
        @include('partials/_navbar')
        <!-- partial -->

        {{-- <div class="flash-news-banner">
          <div class="container">
            <div class="d-lg-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">
                <span class="badge badge-dark mr-3">Flash news</span>
                <p class="mb-0">
                  Lorem Ipsum has been the industry's standard dummy text ever
                  since the 1500s.
                </p>
              </div>
              <div class="d-flex">
                <span class="mr-3 text-danger">Wed, March 4, 2020</span>
                <span class="text-danger">30°C,London</span>
              </div>
            </div>
          </div>
        </div> --}}

        <div class="content-wrapper">
          @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">{{ $message }}</div>
          @elseif ($message = Session::get('failed'))
            <div class="alert alert-warning" role="alert">{{ $message }}</div>
          @endif
            @yield('content')
        </div>
        <!-- main-panel ends -->
        <!-- change password modal-->
        <div class="modal fade" id="cpmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <form method="POST" action="{{ route('users.changepassword') }}">
                @csrf 
              <div class="modal-body">
                   @foreach ($errors->all() as $error)
                      <p class="text-danger">{{ $error }}</p>
                   @endforeach 

                  <div class="form-group row">
                      <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                      <div class="col-md-6">
                          <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                      <div class="col-md-6">
                          <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                      </div>
                  </div>

                  <div class="form-group row">
                      <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm Password</label>

                      <div class="col-md-6">
                          <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>

            </div>
          </div>
        </div>
        <!-- ./change passsword modal -->

        <!-- container-scroller ends -->

        <!-- partial:partials/_footer.html -->
        @include('partials/_footer')
        <!-- partial -->
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
    @stack('scripts')

  </body>
</html>
