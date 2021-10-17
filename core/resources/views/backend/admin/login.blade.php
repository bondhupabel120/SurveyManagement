<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login | {{ $appName }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/backend/img/pharmacy_logo.png') }}" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/login/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/login/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/login/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}">

  </head>
  <body>


  <div class="d-md-flex half">
    <div class="bg" style="background-image: url('{{ asset('assets/login/images/bg_1.jpg') }}');"></div>
    {{-- <div class="bg" style="background-image: url('{{ asset('assets/backend/img/login_side.jpg') }}');"></div> --}}
    <div class="contents">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-12">
            <div class="form-block mx-auto">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              <div class="text-center mb-5">
              <h3>Login to <strong>Admin</strong></h3>
              <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p> -->
              </div>
              <form action="{{ route('admin.loginCheck') }}" method="POST">
                  @csrf
                <div class="form-group first">
                  <label for="username">Email or Phone</label>
                  <input type="text" name="email" class="form-control" placeholder="your-email@gmail.com" id="username">
                </div>
                <div class="form-group last mb-3">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Your Password" id="password">
                </div>

                {{-- <div class="d-sm-flex mb-5 align-items-center">
                  <label class="control control--checkbox mb-3 mb-sm-0"><span class="caption">Remember me</span>
                    <input type="checkbox" checked="checked"/>
                    <input type="checkbox" id="remember" name="remember"/>
                    <div class="control__indicator"></div>
                  </label>
                  <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                </div> --}}

                <input type="submit" value="Log In" class="btn btn-block btn-primary">
                <div class="text-center">
                    <a href="{{ route('index') }}" class="btn btn-sm btn-success text-white pt-3 mt-2" style="text-decoration: none"><i class="fas fa-backward"></i>Back to Main</a>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>



    <script src="{{ asset('assets/login/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/main.js') }}"></script>
  </body>
</html>
