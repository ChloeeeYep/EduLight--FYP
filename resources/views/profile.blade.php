<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | EduLight</title>
    <!--- custom css link-->
    <link rel="stylesheet" href="{{ URL::asset('asset/css/profile.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link rel="shortcut icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center py-3 mb-4" style="padding-bottom: 0px !important">
          <a href="{{ route('home') }}" class="btn-back" style="font-size: 20px; color: black; background-color: white; border-color:white;">
              <i class="fa fa-arrow-left"></i> 
          </a>
          <h4 class="font-weight-bold py-3 mb-4" style="margin-top: 10px;">
              Account settings
          </h4>
        </div>
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">General</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-change-password">Change password</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-info">Info</a>                    
                    </div>
                </div>
                <div class="col-md-9">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">
                            <hr class="border-light m-0">
                            <div class="card-body">

                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control mb-1" maxlength="100" name="username" value="{{ old('username', $user->username) }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Full Name (Optional)</label>
                                    <input type="text" id="name" class="form-control" maxlength="100" name="name" value="{{ old('name') ?? $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" class="form-control mb-1" maxlength="100" name="email" value="{{ old('email') ?? $user->email }}">                               
                                </div>                            
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">                            
                                <div class="form-group">
                                    <label class="form-label">New password (Optional)</label>
                                    <input type="password" class="form-control" maxlength="100" name="new_password">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Repeat new password (Optional)</label>
                                    <input type="password" class="form-control"  maxlength="100" name="confirm_password">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-info">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Bio (Optional)</label>
                                    <textarea class="form-control" name="bio" rows="5" style="min-height: 140px">{{ old('bio') ?? $user->bio }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Birthday (Optional)</label>
                                    <div class="row">
                                        <!-- Day selection -->
                                        <div class="col">
                                            <select class="custom-select" name="birthday_day" id="birthday-day">
                                                <option value="">Day</option>
                                                @for ($i = 1; $i <= 31; $i++)
                                                    <option value="{{ $i }}" {{ (isset($birthdayComponents['day']) && $birthdayComponents['day'] == $i) ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <!-- Month selection -->
                                        <div class="col">
                                            <select class="custom-select" name="birthday_month" id="birthday-month">
                                                <option value="">Month</option>
                                                @foreach (['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'] as $monthNum => $monthName)
                                                    <option value="{{ $monthNum }}" {{ $monthNum == $birthdayComponents['month'] ? 'selected' : '' }}>{{ $monthName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Year selection -->
                                        <div class="col">
                                            <select class="custom-select" name="birthday_year" id="birthday-year">
                                                <option value="">Year</option>
                                                @for ($i = now()->year; $i >= now()->year - 100; $i--)
                                                    <option value="{{ $i }}" {{ $i == $birthdayComponents['year'] ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Country (Optional)</label>
                                    <select class="custom-select" name="country" id="country">
                                    <option value="" {{ is_null($user->country) ? 'selected' : '' }}>Select Country</option>
                                        @foreach ($countries as $code => $name)
                                            <option value="{{ $code }}" {{ $user->country == $code ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body pb-2">
                                <h6 class="mb-4">Contacts</h6>
                                <div class="form-group">
                                    <label class="form-label">Phone (Optional)</label>
                                    <input type="text" class="form-control" id="phone" maxlength="11" name="phone" value="{{ old('phone') ?? $user->phone }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Website (Optional)</label>
                                    <input type="text" class="form-control" name="website" value="{{ old('website') ?? $user->website }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Transcript (Optional)</label>
                                    <input type="file" name="file" class="form-control" style="height: 45px">
                                    @if($user->file)
                                        Current File: <a href="{{ Storage::url($user->file) }}" target="_blank">View File</a>
                                    @endif                           
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mt-3" style="margin-bottom: 50px;">
            <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
            <button type="button" class="btn btn-default" style="background:#e9ecef">Cancel</button>
        </div>
        </form>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">        
        // Get the cancel button
        const cancelButton = document.querySelector('button.btn.btn-default');

        // Add a click event listener to the cancel button
        cancelButton.addEventListener('click', function () {
            // Reload the page to reset all form values to their original state
            window.location.reload();
        });
    </script>

    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function () {
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

		document.getElementById('phone').addEventListener('input', function(event) {
            var phoneInput = event.target.value;
			if (!/^\d*\.?\d*$/.test(phoneInput)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Phone',
                    text: 'Please enter numeric values only.',
                });
                event.target.value = ''; // Clear the input field
            }
        });
    });
    </script>
</body>

</html>