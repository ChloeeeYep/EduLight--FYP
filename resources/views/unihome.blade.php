<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<!-- My CSS -->
	<link rel="stylesheet" href="{{ URL::asset('asset/css/unihome.css') }}">
	<title>Univeristy | EduLight</title>
</head>
<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-school'></i>
			@if(Auth::check()) 
			<span class="text">{{ Auth::user()->username }}</span>
			@endif
		</a>
		<ul class="side-menu top">
			<li class="active">
                <a href="{{ route('unihome') }}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="{{ route('scholarship') }}">
					<i class='bx bxs-graduation'></i>
					<span class="text">scholarship</span>
				</a>
			</li>
           
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
			<a href="{{ route('uniprofile.show') }}" class="profile">
				<i class="fas fa-user-circle"></i> <!-- Example using Font Awesome -->
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<!-- <ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>             
					</ul> -->
				</div>

				<form action="{{ route('searchapplicant') }}" method="GET">
					<div class="form-input">
						<input type="search" name="query" placeholder="Search..." value="{{ request()->query('query') }}">
						<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
					</div>
				</form>


				<a href="{{route('unihome')}}" class="btn-reset">
					<i class='bx bx-refresh'></i>
					<span class="text">Reset</span>
				</a>

				<!-- Status -->
                <div class="dropdown">
                    <button class="dropbtn">
                        <i class='bx bx-filter' style="font-size:25px"></i>
                        Status <i class="fa fa-chevron-down" aria-hidden="true" style="margin-left: 26px;"></i>
                    </button>
					<div class="dropdown-content">
						<a href="{{ route('filterapplicant', ['status' => 'Pending']) }}">Pending</a>
						<a href="{{ route('filterapplicant', ['status' => 'Accept']) }}">Accept</a>
						<a href="{{ route('filterapplicant', ['status' => 'Reject']) }}">Reject</a>
					</div>
                </div>

				<a href="{{ route('export.applicants.csv') }}" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download CSV</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-user'></i>
					<span class="text">
						<h3>{{ $statusTotals['total'] }}</h3>
						<p>Applicants</p>
					</span>
				</li>            
				<li>
					<i class='bx bxs-user'></i>
					<span class="text">
						<h3>{{ $statusTotals['pending'] }}</h3>
						<p>Pending</p>
					</span>
				</li>            
				<li>
					<i class='bx bxs-check-circle'></i>
					<span class="text">
						<h3>{{ $statusTotals['accept'] }}</h3>
						<p>Accept</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-x-circle'></i>
					<span class="text">
						<h3>{{ $statusTotals['reject'] }}</h3>
						<p>Reject</p>
					</span>
				</li>
			</ul>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Request</h3>
						<!-- <i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i> -->
					</div>
					<table>
						<thead>
							<tr>
								<th style="width: 10%;">No.</th>
								<th style="width: 10%;">Full Name</th>
								<th style="width: 50%;">Scholarship Title</th>
								<th style="width: 10%;">Status</th>
							</tr>
						</thead>
						<tbody>
							@foreach($applicants as $index => $applicant)
								<tr>
									<td>{{ $index + 1 }}</td>
									<td><a href="{{ route('editapplication', $applicant->id) }}">{{ $applicant->name }}</a></td>
									<td><a href="{{ route('showscholarship', ['id' => $applicant->scholarship->id]) }}">{{ $applicant->scholarship->title ?? 'N/A' }}</td>
									<td><span class="status {{ strtolower($applicant->status) }}">{{ $applicant->status }}</span></td>
								</tr>
							@endforeach																									
						</tbody>
					</table>
				</div>				
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ URL::asset('asset/js/adminhome.js') }}"></script>
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
</body>
</html>