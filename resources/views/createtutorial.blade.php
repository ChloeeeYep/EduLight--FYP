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
	<title>Tutorial | EduLight</title>
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
			<li class="active">
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
			<form action="{{route('storetutorial')}}" method="POST">
        @csrf
        <div class="container">
            <div class="form-container">
                <h2>Add New Tutorial</h2>
                <form>
					<div class="form-group">
						<label for="type">Type  <span class="optional">*</span></label>
						<select id="type" name="type">
							<option value="HTML">HTML</option>
							<option value="CSS">CSS</option>
							<option value="JAVASCRIPT">JavaScript</option>
							<option value="JAVA">Java</option>
							<option value="PYTHON">Python</option>
							<option value="C">C</option>
							<option value="C++">C++</option>
							<option value="C#">C#</option>
							<option value="R">R</option>
							<option value="PHP">PHP</option>
							<option value="SWIFT">Swift</option>
							<option value="KOTLIN">Kotlin</option>
							<option value="TYPESCRIPT">TypeScript</option>
							<option value="RUBY">Ruby</option>
							<option value="GO">Go</option>
							<option value="RUST">Rust</option>
							<option value="DART">Dart</option>
							<option value="SCALA">Scala</option>
							<option value="PERL">Perl</option>
							<option value="LUA">Lua</option>
							<option value="HASKELL">Haskell</option>
							<option value="ERLANG">Erlang</option>
							<option value="CLOJURE">Clojure</option>
							<option value="MATLAB">Matlab</option>
							<option value="GROOVY">Groovy</option>
							<option value="POWERSHELL">PowerShell</option>
							<option value="SHELL">Shell Scripting (Bash, Zsh)</option>
							<option value="OBJECTIVE-C">Objective-C</option>
							<option value="VISUAL BASIC">Visual Basic .NET</option>
							<option value="SQL">SQL</option>
							<option value="ASSEMBLY LANGUAGE">Assembly Language</option>
							<option value="PASCAL">Pascal</option>
							<option value="FORTRAN">Fortran</option>
							<option value="COBOL">COBOL</option>
							<option value="ELM">Elm</option>
							<option value="JULIA">Julia</option>
							<option value="SCHEME">Scheme</option>
							<option value="PROLOG">Prolog</option>
							<option value="SAS">SAS</option>
							<option value="APL">APL</option>
							<option value="ADA">Ada</option>
							<option value="OCAML">OCaml</option>
							<option value="ELIXIR">Elixir</option>
							<option value="VHDL">VHDL</option>
							<option value="VERILOG">Verilog</option>
						</select>
					</div>

					<div class="form-group">
						<label for="title">Title <span class="optional">*</span></label>
						<input type="text" id="name" maxlength="250" name="name" required>
					</div>

					<div class="form-group">
						<label for="content">Content<span class="optional">*</span></label>
						<textarea id="details" name="details" rows="4" required></textarea>
					</div>  
					
					<div class="form-group">
						<label for="example">Example<span class="optional">*</span></label>
						<textarea id="example" name="example" rows="4" required></textarea>
					</div>

					<div class="form-group">
						<label for="question">Question<span class="optional">*</span></label>
						<input type="text" id="game" name="question" maxlength="250" required>
					</div> 

					<div class="form-group">
						<label for="option1">Correct Answer<span class="optional">*</span></label>
						<input type="text" id="option1" name="option1" maxlength="250" required>
					</div> 

					<div class="form-group">
						<label for="option2">Wrong Answer<span class="optional">*</span></label>
						<input type="text" id="option2" name="option2" maxlength="250" required>
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
</body>
</html>