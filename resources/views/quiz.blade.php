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
	<title>Quiz | EduLight</title>
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
            <li class="active">
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
					<h1>Quiz</h1>
				</div>
                <form action="searchquiz" method="GET">
                    <div class="form-input">
                        <input type="search" name="query" placeholder="Search..." value="{{ request()->query('query') }}">
                        <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                    </div>
			    </form>

				<a href="{{ route('quiz') }}" class="btn-reset">
					<i class='bx bx-refresh'></i>
					<span class="text">Reset</span>
				</a>

				<div class="dropdown">
					<button class="dropbtn">
						<i class='bx bx-filter' style="font-size:25px"></i>
						Type <i class="fa fa-chevron-down" aria-hidden="true" style="margin-left:41px"></i>
					</button>
					<div class="dropdown-content">
						<!-- Type filter options -->
						<a href="{{ route('quiz') }}?type=HTML">HTML</a>
						<a href="{{ route('quiz') }}?type=CSS">CSS</a>
						<a href="{{ route('quiz') }}?type=PHP">PHP</a>
						<a href="{{ route('quiz') }}?type=JAVASCRIPT">JavaScript</a>
						<a href="{{ route('quiz') }}?type=JAVA">Java</a>
						<a href="{{ route('quiz') }}?type=PYTHON">Python</a>
						<a href="{{ route('quiz') }}?type=C">C</a>
						<a href="{{ route('quiz') }}?type=C++">C++</a>
						<a href="{{ route('quiz') }}?type=C#">C#</a>
						<a href="{{ route('quiz') }}?type=R">R</a>
						<a href="{{ route('quiz') }}?type=SWIFT">Swift</a>
						<a href="{{ route('quiz') }}?type=KOTLIN">Kotlin</a>
						<a href="{{ route('quiz') }}?type=TYPESCRIPT">TypeScript</a>
						<a href="{{ route('quiz') }}?type=RUBY">Ruby</a>
						<a href="{{ route('quiz') }}?type=GO">Go</a>
						<a href="{{ route('quiz') }}?type=RUST">Rust</a>
						<a href="{{ route('quiz') }}?type=DART">Dart</a>
						<a href="{{ route('quiz') }}?type=SCALA">Scala</a>
						<a href="{{ route('quiz') }}?type=PERL">Perl</a>
						<a href="{{ route('quiz') }}?type=LUA">Lua</a>
						<a href="{{ route('quiz') }}?type=HASKELL">Haskell</a>
						<a href="{{ route('quiz') }}?type=ERLANG">Erlang</a>
						<a href="{{ route('quiz') }}?type=CLOJURE">Clojure</a>
						<a href="{{ route('quiz') }}?type=MATLAB">Matlab</a>
						<a href="{{ route('quiz') }}?type=GROOVY">Groovy</a>
						<a href="{{ route('quiz') }}?type=POWERSHELL">PowerShell</a>
						<a href="{{ route('quiz') }}?type=SHELL">Shell Scripting (Bash, Zsh)</a>
						<a href="{{ route('quiz') }}?type=OBJECTIVE-C">Objective-C</a>
						<a href="{{ route('quiz') }}?type=VISUAL BASIC">Visual Basic .NET</a>
						<a href="{{ route('quiz') }}?type=SQL">SQL</a>
						<a href="{{ route('quiz') }}?type=ASSEMBLY LANGUAGE">Assembly Language</a>
						<a href="{{ route('quiz') }}?type=PASCAL">Pascal</a>
						<a href="{{ route('quiz') }}?type=FORTRAN">Fortran</a>
						<a href="{{ route('quiz') }}?type=COBOL">COBOL</a>
						<a href="{{ route('quiz') }}?type=ELM">Elm</a>
						<a href="{{ route('quiz') }}?type=JULIA">Julia</a>
						<a href="{{ route('quiz') }}?type=SCHEME">Scheme</a>
						<a href="{{ route('quiz') }}?type=PROLOG">Prolog</a>
						<a href="{{ route('quiz') }}?type=SAS">SAS</a>
						<a href="{{ route('quiz') }}?type=APL">APL</a>
						<a href="{{ route('quiz') }}?type=ADA">Ada</a>
						<a href="{{ route('quiz') }}?type=OCAML">OCaml</a>
						<a href="{{ route('quiz') }}?type=ELIXIR">Elixir</a>
						<a href="{{ route('quiz') }}?type=VHDL">VHDL</a>
						<a href="{{ route('quiz') }}?type=VERILOG">Verilog</a>
					</div>
				</div>

			    <a href="{{ route('createquiz') }}" class="btn-add">
					<i class='bx bx-add-to-queue'></i>
					<span class="text">Add New</span>
				</a>

			</div>

            <!-- Table -->
            @php
			$types = ['HTML', 'CSS', 'PHP', 'JAVASCRIPT', 'JAVA', 'PYTHON', 'C', 'C++', 'C#', 'R', 
					'SWIFT', 'KOTLIN', 'TYPESCRIPT', 'RUBY', 'GO', 'RUST', 'DART', 'SCALA', 'PERL', 'LUA', 
					'HASKELL', 'ERLANG', 'CLOJURE', 'MATLAB', 'GROOVY', 'POWERSHELL', 'SHELL', 'OBJECTIVE-C', 
					'VISUAL BASIC', 'SQL', 'ASSEMBLY LANGUAGE', 'PASCAL', 'FORTRAN', 'COBOL', 'ELM', 'JULIA', 
					'SCHEME', 'PROLOG', 'SAS', 'APL', 'ADA', 'OCAML', 'ELIXIR', 'VHDL', 'VERILOG']; 
			@endphp

			@foreach ($types as $type)
				@php 
					$quizOfType = $quizzes->where('type', $type);
				@endphp

				@if($quizOfType->isNotEmpty())
					<div class="table-data">
						<div class="order">
							<div class="head">
								<h3>{{$type}}</h3>
							</div>
							<table>
								<thead>
									<tr>
										<th style="width: 10%;">No.</th>
										<th style="width: 30%;">Question</th>
										<th style="width: 30%;">Correct Answer</th>
										<th style="width: 20%;">Action</th>
									</tr>
								</thead>
								<tbody>
									@php $counter = 1; @endphp
									@foreach ($quizOfType as $item)					
										<tr>
											<td>{{ $counter++ }}</td>
											<td>{{ $item->question }}</td>
											<td>{{ $item->correct }}</td>
											<td>
												<div class="button-group">
													<a href="{{ route('showquiz' , $item->id) }}" class="btn-action btn-info">
														<i class='bx bx-bullseye'></i>
														<span>View</span>
													</a>
													<a href="{{ route('editquiz' , $item->id) }}" class="btn-action btn-edit">
														<i class='bx bx-edit-alt'></i>
														<span>Edit</span>
													</a>
													<form action ="{{ route('destroyquiz' , $item->id) }}" method="POST" class="form-action">
														@csrf
														@method('DELETE')
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
				@endif
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