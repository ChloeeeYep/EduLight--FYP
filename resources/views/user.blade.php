<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->    
	<link rel="shortcut icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<!-- My CSS -->
	<link rel="stylesheet" href="{{ URL::asset('asset/css/adminhome.css') }}">
	<title>Admin | EduLight</title>
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
			<div class="head-title">
				<div class="left">
					<h1>User</h1>
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
				<form action="searchuser" method="GET">
                    <div class="form-input">
                        <input type="search" name="query" placeholder="Search..." value="{{ request()->query('query') }}">
                        <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                    </div>
			    </form>

				<a href="{{route('user')}}" class="btn-reset">
					<i class='bx bx-refresh'></i>
					<span class="text">Reset</span>
				</a>

				<div class="dropdown">
					<button class="dropbtn">
						<i class='bx bx-filter' style="font-size:25px"></i>
						Filters <i class="fa fa-chevron-down" aria-hidden="true" style="margin-left:41px"></i>
					</button>
					<div class="dropdown-content">
						<a href="{{ route('filteruser', ['type' => 'P']) }}">User</a> <!-- Assuming 'P' is the code for Users -->
						<a href="{{ route('filteruser', ['type' => 'U']) }}">University</a> <!-- Assuming 'U' is the code for Universities -->
						<a href="{{ route('filteruser', ['type' => 'A']) }}">Admin</a> <!-- Assuming 'A' is the code for Admins -->
					</div>
				</div>


			    <a href="{{route('createuser')}}" class="btn-add">
					<i class='bx bx-add-to-queue'></i>
					<span class="text">Add New</span>
				</a>

				<a href="{{ route('export.users.csv') }}" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download CSV</span>
				</a>
			</div>

			<ul class="box-info">
                <li>
					<i class='bx bxs-group' ></i>
					<span class="text">
					<h3>{{ $userTypeCounts['P'] ?? 0 }}</h3>
						<p>User</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
					<h3>{{ $userTypeCounts['U'] ?? 0 }}</h3>
						<p>University</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
					<h3>{{ $userTypeCounts['A'] ?? 0 }}</h3>
						<p>Admin</p>
					</span>
				</li>
			</ul>
		
            <!-- Table -->
			@foreach ($groupedusers as $user_type => $usersGroup)
            <div class="table-data">
                <div class="order">
                    <div class="head">
					<h3>{{ $userTypeNames[$user_type] ?? 'Unknown Type' }}</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 10%;">No.</th>
                                <th style="width: 30%;">Name</th>
								<th style="width: 30%;">Email</th>
                                <th style="width: 20%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
						@php $counter = 1; @endphp
							@foreach ($usersGroup as $item)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $item->username }}</td>
									<td>{{ $item->email }}</td>
                                    <td>
                                        <div class="button-group">
                                            <a href="{{ route('showusers' , $item->id) }}" class="btn-action btn-info">
                                                <i class='bx bx-bullseye'></i>
                                                <span>View</span>
                                            </a>
                                            <a href="{{ route('edituser' , $item->id) }}" class="btn-action btn-edit">
                                                <i class='bx bx-edit-alt'></i>
                                                <span>Edit</span>
                                            </a>
                                            <form action ="{{ route('deleteusers', $item->id) }}" method="POST" class="form-action">
												@csrf
												@method('POST')
                                                <button type="submit" class="btn-action btn-delete">
													<i class='bx bx-trash'></i>
													<span>Delete</span>
												</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
							@endforeach
                        </tbody>
                    </table>
                </div>          
            </div>
			@endforeach
            <!-- Table -->
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
	
	<script type="text/javascript">
  	document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
      button.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent form from submitting right away
        const form = this.closest('form'); // Find the form element that contains the button

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit(); // Submit the form if user confirms deletion
          }
        });
      });
    });
  });
</script>
</body>
</html>