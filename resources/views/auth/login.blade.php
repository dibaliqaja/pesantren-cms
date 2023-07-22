<!-- 
  PROJECT: Pesantren CMS
  AUTHOR: Muhammad Iqbal (dibaliqaja)
  GITHUB: https://github.com/dibaliqaja/pesantren-cms
  TWITTER: https://twitter.com/dibaliqaja
  FACEBOOK: https://facebook.com/dibaliqaja
  LINKEDIN: https://linkedin.com/in/dibaliqaja
  EMAIL: dibaliqaja@gmail.com
-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; Sistem Manajemen Pondok Pesantren</title>
  <!-- Favicon -->
  <link rel="favicon icon" href="{{ asset('assets/img/ponpes.ico') }}" type="image/x-icon">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap-social/bootstrap-social.css') }}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/ponpes-style.css') }}">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="{{ asset('assets/img/ponpes.svg') }}" alt="logo" width="120">
            </div>

            <div class="card card-primary">
              @if (session('alert'))
                <div class="alert alert-danger m-2" role="alert">
                  <div class="text-center">{{ session('alert') }}</div>
                </div>
              @endif

              <div class="card-body">
                <div class="text-center mb-4"><h6>Sistem Manajemen <br>Pondok Pesantren</h6></div>
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                @csrf
                   <div class="form-group">
                        <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <div class="input-group" id="show_hide_password">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                      <div class="input-group-append">
                        <div class="input-group-text">
                            <a href="javascript:void(0)"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                      </div>

                      @error('password')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      <div style="font-size: 15px">Login</div>
                    </button>
                  </div>
                </form>

              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; {{ date('Y') }}
              <div class="bullet"></div> Made by <a href="https://github.com/dibaliqaja" target="_blank">Muhammad Iqbal</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/js/digital-sign.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>

  <!-- Page Specific JS File -->
  <script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });
    });
  </script>

  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
