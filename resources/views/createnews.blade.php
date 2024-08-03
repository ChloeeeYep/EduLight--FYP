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
	<title>News | EduLight</title>
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
            <li class="active">
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
			<form action="{{route('storenews')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="form-container">
                <h2>Add News</h2>
                <form>
				<div class="form-group">
                        <label for="category">Category<span class="optional">*</span></label>
                        <input type="text" id="category" name="category" maxlength="250" required>
                    </div>

                    <div class="form-group">
                        <label for="title">Title<span class="optional">*</span></label>
                        <input type="text" id="title" name="title" maxlength="250" required>
                    </div>

					<div class="form-group">
						<label for="description">Description<span class="optional">*</span></label>
						<textarea id="description" name="description" rows="4" required></textarea>
					</div>

                    <div class="form-group">
                        <label for="introduction">Introduction<span class="optional">*</span></label>
                        <textarea id="introduction" maxlength="250" name="introduction" rows="4" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="title1">Title 1</label>
                        <input type="text" id="title1" maxlength="250" name="title1">
                    </div>

                    <div class="form-group">
						<label for="description1">Description 1</label>
						<textarea id="description1" name="description1" rows="4"></textarea>
					</div>

                    <div class="form-group">
                        <label for="image">Image<span class="optional">*</span></label>
                        <input type="file" id="image" name="image" required>
                    </div> 

                    <button type="submit" class="btn-save">Save</button>
                </form>
            </div>
        </div>
    </form>

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->



    <script type="text/javascript" src="{{ URL::asset('asset/js/adminhome.js') }}"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            });
        @endif
      });
    </script>
</body>
</html>