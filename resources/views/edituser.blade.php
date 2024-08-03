<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<!-- My CSS -->
	<link rel="shortcut icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
	<link rel="stylesheet" href="{{ URL::asset('asset/css/adminhome.css') }}">
	<title>Edit | EduLight</title>
</head>
<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
	<a href="#" class="brand">
			<i class='bx bxs-user'></i>
			@if(Auth::check()) 
			<span class="text">{{ Auth::user()->username }}</span>
			@endif
		</a>

		<ul class="side-menu top">
			<li>
				<a href="{{ route('adminhome') }}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
                <a href="{{ route('tutorial') }}">
					<i class='bx bxs-book-content' ></i>
					<span class="text">Tutorial</span>
				</a>
			</li>
            <li>
				<a href="{{ route('quiz') }}">
                    <i class='bx bxs-brain' ></i>
					<span class="text">Quiz</span>
				</a>
			</li>
            <li>
				<a href="{{ route('news') }}">
                    <i class='bx bxs-book-reader' ></i>
					<span class="text">News</span>
				</a>
			</li>
            <li> 
				<a href="{{ route('course') }}">
                    <i class='bx bx-library' ></i>
					<span class="text">Course</span>
				</a>
			</li>
            <li>
				<a href="{{ route('instructor') }}">
				<i class='bx bxs-user'></i>
					<span class="text">Instructor</span>
				</a>
			</li>
			<li class="active">
				<a href="{{ route('user') }}">
					<i class='bx bxs-group' ></i>
					<span class="text">User</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="{{ route('logout') }}" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->


	
	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="{{ route('adminprofile.show') }}" class="profile">
				<i class="fas fa-user-circle"></i> <!-- Example using Font Awesome -->
			</a>
		</nav>
		<!-- NAVBAR -->
		<!-- MAIN -->
		<main>
			<div class="mt-5">
        </div>
		<form method="POST" action="{{ route('updateusers', $user->id) }}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="container">
				<div class="form-container">
					@if($user->user_type == 'U')
						<h2>Edit University</h2>
					@elseif($user->user_type == 'P')
						<h2>Edit User</h2>
					@elseif($user->user_type == 'A')
						<h2>Edit Admin</h2>
					@endif
					<form>

					<div class="form-group">
						@if($user->user_type == 'U')
							<label for="username">University Name</label>
							<input type="text" id="username" name="username" value="{{ $user->username }}" maxlength="100" required>
						@else
							<label for="username">Username<span class="optional">*</span></label>
							<input type="text" id="username" name="username" value="{{ $user->username }}" maxlength="100" required>
						@endif
					</div>


                        <div class="form-group">
							<label for="email">Email <span class="optional">*</span></label>
							<input type="email" id="email" maxlength="100" name="email" value="{{ $user->email }}" required>
						</div>

                        <!-- <div class="form-group">
                        <label for="name">Passwords <span class="optional">*optional</span></label>
							<input type="text" name="new_password">
						</div>

                        <div class="form-group">
                        <label for="name">Confirm Passwords <span class="optional">*optional</span></label>
							<input type="text" name="confirm_password">
						</div> -->


                        @if($user->user_type == 'P' || $user->user_type == 'A')
                        <div class="form-group">
							<label for="name">Full Name</label>
							<input type="text" id="name" name="name" maxlength="100" value="{{ $user->name }}">
						</div>
						@endif

						<div class="form-group">
							<label class="form-label">Birthday</label>
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
											<option value="{{ $monthNum }}" {{ (isset($birthdayComponents['month']) && $birthdayComponents['month'] == $monthNum) ? 'selected' : '' }}>{{ $monthName }}</option>
										@endforeach
									</select>
								</div>
								<!-- Year selection -->
								<div class="col">
									<select class="custom-select" name="birthday_year" id="birthday-year">
										<option value="">Year</option>
										@for ($i = now()->year; $i >= now()->year - 100; $i--)
											<option value="{{ $i }}" {{ (isset($birthdayComponents['year']) && $birthdayComponents['year'] == $i) ? 'selected' : '' }}>{{ $i }}</option>
										@endfor
									</select>
								</div>
							</div>
						</div>


						<div class="form-group">
							<label class="form-label">Country</label>
							<select class="custom-select" name="country" id="country">
								<option value="" {{ is_null($user->country) ? 'selected' : '' }}>Select Country</option>
								@foreach ($countries as $code => $name)
									<option value="{{ $code }}" {{ $user->country == $code ? 'selected' : '' }}>{{ $name }}</option>
								@endforeach
							</select>
						</div>


                        <div class="form-group">
							<label for="phone">Phone</label>
							<input type="text" id="phone" maxlength="11" name="phone" maxlength="11" value="{{ $user->phone }}">
						</div>

                        <div class="form-group">
							<label for="website">Website</label>
							<input type="text" id="website" name="website" value="{{ $user->website }}">
						</div>

						<div class="form-group">
							<label for="file">Details</label>
                            @if(!empty($user->file))
                                    Current File: <a href="{{ Storage::url($user->file) }}" target="_blank">View File</a>
                            @endif
							<input type="file" id="file" name="file" value="{{ $user->file }}" >
						</div> 

                        

						<button type="submit" class="btn-save">Update</button>
					</form>
				</div>
			</div>			
		</form>
	</main>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ URL::asset('asset/js/adminhome.js') }}"></script>
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