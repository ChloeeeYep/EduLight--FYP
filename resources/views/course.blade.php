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
	<link rel="stylesheet" href="{{ URL::asset('asset/css/adminhome.css') }}">
	<title>Course | EduLight</title>
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
			<li >
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
            <li class="active"> 
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
			<li>
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
					<h1>Course</h1>
				</div>
                <form action="searchcourse" method="GET">
                    <div class="form-input">
                        <input type="search" name="query" placeholder="Search..." value="{{ request()->query('query') }}">
                        <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                    </div>
			    </form>

				<a href="{{ route('course') }}" class="btn-reset">
					<i class='bx bx-refresh'></i>
					<span class="text">Reset</span>
				</a>

                <div class="dropdown">
                    <button class="dropbtn">
                        <i class='bx bx-filter' style="font-size:25px"></i>
                        Price <i class="fa fa-chevron-down" aria-hidden="true" style="margin-left:41px"></i>
                    </button>
					<div class="dropdown-content">
						<a href="/filtercourse?sort=price-asc" id="sort-low-to-high">Low To High</a>
						<a href="/filtercourse?sort=price-desc" id="sort-high-to-low">High To Low</a>
					</div>
                </div>

			    <a href="{{ route('createcourse') }}" class="btn-add">
					<i class='bx bx-add-to-queue'></i>
					<span class="text">Add New</span>
				</a>

			</div>
            <!-- Table -->
            <div class="table-data">
                <div class="order">
                    <div class="head">
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 10%;">No.</th>
                                <th style="width: 20%;">Image</th>
                                <th style="width: 20%;">Title</th>
                                <th style="width: 20%;">Price</th>
                                <th style="width: 20%;">Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $counter = 1; @endphp
                            @foreach($courses as $course)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td><img src="/images/{{ $course->photo }}" style="width:150px;height:110px;"></td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->price }}</td>
                                    <td>{{ $course->level }}</td>
                                    <td>
                                        <div class="button-group">
                                            <a href="{{ route('showcourse' , $course->id) }}" class="btn-action btn-info">
                                                <i class='bx bx-bullseye'></i>
                                                <span>View</span>
                                            </a>
                                            <a href="{{ route('editcourse' , $course->id) }}" class="btn-action btn-edit">
                                                <i class='bx bx-edit-alt'></i>
                                                <span>Edit</span>
                                            </a>
                                            <a href="{{ route('video', $course->id) }}" class="btn-action btn-addfile">
                                                <i class='bx bx-video'></i>
                                                <span>Video</span>
                                            </a>
                                            <form action ="{{ route('destroycourse' , $course->id) }}" method="POST" class="form-action">
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