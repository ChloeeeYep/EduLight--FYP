<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('asset/css/login.css') }}">
    <title>Signup | EduLight</title>
</head>
<a href="{{ route('home') }}" class="logo">
        <img src="{{ asset('img/logo.svg') }}" width="162" height="50" alt="EduLight logo">
</a>
<body>
    <form action="{{route('signup.post')}}" method="POST">
    @csrf
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="row border rounded-5 p-3 bg-white shadow box-area">
                <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
                    <div class="featured-image mb-3">
                    <img src="{{ asset('img/login.png') }}" class="img-fluid" style="width: 250px;">
                </div>
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join EduLight to learn yourself.</small>
            </div> 
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>New Member?</h2>
                        <p>Sign up For Free.</p>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="UserName" name="username" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address" name="email" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" name="password" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Confirm Password" name="confirm" required>
                    </div>
                    <div class="input-group mb-3">
                        <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Sign up</button>
                    </div>
                    <div class="row">
                        <small>Already have an account? <a href="{{ route('signin') }}">Sign In</a></small>
                    </div>
                </div>
            </div> 
        </div>
    </form>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function () {
          @if(session('error'))
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: '{{ session('error') }}',
              });
          @endif

          @if(session('success'))
              Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: '{{ session('success') }}',
              });
          @endif
      });
    </script>

    <script type="text/javascript">
    	document.addEventListener('DOMContentLoaded', function () {
        @if ($errors->any())
            var errorMessage = '';
            @foreach ($errors->all() as $error)
                errorMessage += '{{ $error }}\n';
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: errorMessage,
                allowOutsideClick: false, // Prevent dismissing the alert by clicking outside
                allowEscapeKey: false, // Prevent dismissing the alert by pressing Esc key
            });
        @endif
    });
    </script>
</body>
</html>