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
			<div class="mt-5">
        </div>
		<form action="{{route('updatecourse' , $item->id)}}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PUT')
			<div class="container">
				<div class="form-container">
					<h2>Edit Course</h2>
					<form>

						<div class="form-group">
							<label for="type">Type<span class="optional">*</span></label>
							<input type="text" id="type" name="type" maxlength="250" value="{{ $item->type }}" required>
						</div>

                        <div class="form-group">
							<label for="title">Title<span class="optional">*</span></label>
							<input type="text" id="title" name="title" maxlength="250" value="{{ $item->title }}" required>
						</div>

                        <div class="form-group">
							<label for="price">Price<span class="optional">*</span></label>
							<input type="text" id="price" maxlength="10" name="price" value="{{ $item->price }}" required>
						</div>

						<div class="form-group">
							<label for="instructor">Instructor<span class="optional">*</span></label>
							<select id="instructor" name="instructor" required>
								@foreach($instructors as $instructor)
									<option value="{{ $instructor->id }}" {{ $instructor->id == $item->instructor ? 'selected' : '' }}>
										{{ $instructor->name }}
									</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">
								<label for="level">Level<span class="optional">*</span></label>
								<select id="level" name="level">
									<option value="BEGINNER" {{ $item->level == 'BEGINNER' ? 'selected' : '' }}>BEGINNER</option>
									<option value="INTERMEDIATE" {{ $item->level == 'INTERMEDIATE' ? 'selected' : '' }}>INTERMEDIATE</option>
									<option value="ADVANCED" {{ $item->level == 'ADVANCED' ? 'selected' : '' }}>ADVANCED</option>
								</select>
						</div>																	

						<div class="form-group">
							<label for="duration">Duration<span class="optional">*</span></label>
							<input type="number" min="1" max="100" id="duration" name="duration" value="{{ $item->duration }}"required>
						</div> 

                        <div class="form-group">
							<label for="lesson">Lesson<span class="optional">*</span></label>
							<input type="number" min="1" max="100" id="lesson" name="lesson" value="{{ $item->lesson }}"required>
						</div> 

                        <div class="form-group">
								<label for="language">Language<span class="optional">*</span></label>
								<select id="language" name="language">
									<option value="ENGLISH" {{ $item->language == 'ENGLISH' ? 'selected' : '' }}>ENGLISH</option>
									<option value="CHINESE" {{ $item->language == 'CHINESE' ? 'selected' : '' }}>CHINESE</option>
									<option value="MALAY" {{ $item->language == 'MALAY' ? 'selected' : '' }}>MALAY</option>
								</select>
						</div>

						<div class="form-group">
							<label for="description">Descirption<span class="optional">*</span></label>
							<textarea id="description" name="description" required>{{ $item->description }}</textarea>
						</div>  

						<div class="form-group">
							<label for="learn1">Learn 1<span class="optional">*</span></label>
							<input type="text" id="learn1" name="learn1" value="{{ $item->learn1 }}" required>
						</div> 

                        <div class="form-group">
							<label for="learn2">Learn 2<span class="optional">*</span></label>
							<input type="text" id="learn2" name="learn2" value="{{ $item->learn2 }}" required>
						</div> 

						<div class="form-group">
							<label for="learn3">Learn 3<span class="optional">*</span></label>
							<input type="text" id="learn3" name="learn3" value="{{ $item->learn3 }}" required>
						</div> 

                        <div class="form-group">
							<label for="photo">Image</label>
							<input type="file" id="photo" name="photo"> 
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
            });
        @endif

		document.getElementById('price').addEventListener('input', function(event) {
            var priceInput = event.target.value;
			if (!/^\d*\.?\d*$/.test(priceInput)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Price',
                    text: 'Please enter numeric values only.',
                });
                event.target.value = ''; // Clear the input field
            }
        });
      });
    </script>
</body>
</html>