<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Boxicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
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
			<div class="mt-5">
				@if($errors->any())
					@foreach($errors ->all() as $error)
						<div class="error-message">{{$error}} </div>
					@endforeach
				@endif

				@if(session()->has('error'))
					<div class="error-message">{{session("error")}} </div>
				@endif
        </div>
		<form action="{{route('updatequiz' , $item->id)}}" method="POST">
			@csrf
			@method('PUT')
			<div class="container">
				<div class="form-container">
					<h2>Edit Quiz</h2>
					<form>
						<div class="form-group">
								<label for="type">Type<span class="optional">*</span></label>
								<select id="type" name="type">
									<option value="HTML" {{ ($item->type) === 'HTML' ? 'selected' : '' }}>HTML</option>
									<option value="CSS" {{ ($item->type) === 'CSS' ? 'selected' : '' }}>CSS</option>
									<option value="JAVASCRIPT" {{ ($item->type) === 'JAVASCRIPT' ? 'selected' : '' }}>JavaScript</option>
									<option value="JAVA" {{ ($item->type) === 'JAVA' ? 'selected' : '' }}>Java</option>
									<option value="PYTHON" {{ ($item->type) === 'PYTHON' ? 'selected' : '' }}>Python</option>
									<option value="C" {{ ($item->type) === 'C' ? 'selected' : '' }}>C</option>
									<option value="C++" {{ ($item->type) === 'C++' ? 'selected' : '' }}>C++</option>
									<option value="C#" {{ ($item->type) === 'C#' ? 'selected' : '' }}>C#</option>
									<option value="R" {{ ($item->type) === 'R' ? 'selected' : '' }}>R</option>
									<option value="PHP" {{ ($item->type) === 'PHP' ? 'selected' : '' }}>PHP</option>
									<option value="SWIFT" {{ ($item->type) === 'SWIFT' ? 'selected' : '' }}>Swift</option>
									<option value="KOTLIN" {{ ($item->type) === 'KOTLIN' ? 'selected' : '' }}>Kotlin</option>
									<option value="TYPESCRIPT" {{ ($item->type) === 'TYPESCRIPT' ? 'selected' : '' }}>TypeScript</option>
									<option value="RUBY" {{ ($item->type) === 'RUBY' ? 'selected' : '' }}>Ruby</option>
									<option value="GO" {{ ($item->type) === 'GO' ? 'selected' : '' }}>Go</option>
									<option value="RUST" {{ ($item->type) === 'RUST' ? 'selected' : '' }}>Rust</option>
									<option value="DART" {{ ($item->type) === 'DART' ? 'selected' : '' }}>Dart</option>
									<option value="SCALA" {{ ($item->type) === 'SCALA' ? 'selected' : '' }}>Scala</option>
									<option value="PERL" {{ ($item->type) === 'PERL' ? 'selected' : '' }}>Perl</option>
									<option value="LUA" {{ ($item->type) === 'LUA' ? 'selected' : '' }}>Lua</option>
									<option value="HASKELL" {{ ($item->type) === 'HASKELL' ? 'selected' : '' }}>Haskell</option>
									<option value="ERLANG" {{ ($item->type) === 'ERLANG' ? 'selected' : '' }}>Erlang</option>
									<option value="CLOJURE" {{ ($item->type) === 'CLOJURE' ? 'selected' : '' }}>Clojure</option>
									<option value="MATLAB" {{ ($item->type) === 'MATLAB' ? 'selected' : '' }}>Matlab</option>
									<option value="GROOVY" {{ ($item->type) === 'GROOVY' ? 'selected' : '' }}>Groovy</option>
									<option value="POWERSHELL" {{ ($item->type) === 'POWERSHELL' ? 'selected' : '' }}>PowerShell</option>
									<option value="SHELL" {{ ($item->type) === 'SHELL' ? 'selected' : '' }}>Shell Scripting (Bash, Zsh)</option>
									<option value="OBJECTIVE-C" {{ ($item->type) === 'OBJECTIVE-C' ? 'selected' : '' }}>Objective-C</option>
									<option value="VISUAL BASIC" {{ ($item->type) === 'VISUAL BASIC' ? 'selected' : '' }}>Visual Basic .NET</option>
									<option value="SQL" {{ ($item->type) === 'SQL' ? 'selected' : '' }}>SQL</option>
									<option value="ASSEMBLY LANGUAGE" {{ ($item->type) === 'ASSEMBLY LANGUAGE' ? 'selected' : '' }}>Assembly Language</option>
									<option value="PASCAL" {{ ($item->type) === 'PASCAL' ? 'selected' : '' }}>Pascal</option>
									<option value="FORTRAN" {{ ($item->type) === 'FORTRAN' ? 'selected' : '' }}>Fortran</option>
									<option value="COBOL" {{ ($item->type) === 'COBOL' ? 'selected' : '' }}>COBOL</option>
									<option value="ELM" {{ ($item->type) === 'ELM' ? 'selected' : '' }}>Elm</option>
									<option value="JULIA" {{ ($item->type) === 'JULIA' ? 'selected' : '' }}>Julia</option>
									<option value="SCHEME" {{ ($item->type) === 'SCHEME' ? 'selected' : '' }}>Scheme</option>
									<option value="PROLOG" {{ ($item->type) === 'PROLOG' ? 'selected' : '' }}>Prolog</option>
									<option value="SAS" {{ ($item->type) === 'SAS' ? 'selected' : '' }}>SAS</option>
									<option value="APL" {{ ($item->type) === 'APL' ? 'selected' : '' }}>APL</option>
									<option value="ADA" {{ ($item->type) === 'ADA' ? 'selected' : '' }}>Ada</option>
									<option value="OCAML" {{ ($item->type) === 'OCAML' ? 'selected' : '' }}>OCaml</option>
									<option value="ELIXIR" {{ ($item->type) === 'ELIXIR' ? 'selected' : '' }}>Elixir</option>
									<option value="VHDL" {{ ($item->type) === 'VHDL' ? 'selected' : '' }}>VHDL</option>
									<option value="VERILOG" {{ ($item->type) === 'VERILOG' ? 'selected' : '' }}>Verilog</option>
								</select>
						</div>

						<div class="form-group">
							<label for="question">Question<span class="optional">*</span></label>
							<input type="text" id="question" name="question" value="{{ $item->question }}" required>
						</div>

						<div class="form-group">
							<label for="correct">Correct Answer<span class="optional">*</span></label>
							<input type="text" id="correct" name="correct" value="{{ $item->correct }}" required>
						</div>  

						<div class="form-group">
							<label for="wrong1">Wrong Answer1<span class="optional">*</span></label>
							<input type="text" id="wrong1" name="wrong1" value="{{ $item->wrong1 }}" required>
						</div>

						<div class="form-group">
							<label for="wrong2">Wrong Answer2<span class="optional">*</span></label>
							<input type="text" id="wrong2" name="wrong2" value="{{ $item->wrong2 }}" required>
						</div> 

						<div class="form-group">
							<label for="wrong3">Wrong Answer3</label>
							<input type="text" id="wrong3" name="wrong3" value="{{ $item->wrong3 }}" >
						</div> 

						<button type="submit" class="btn-save">Update</button>
					</form>
				</div>
			</div>			
		</form>
	</main>
    <script type="text/javascript" src="{{ URL::asset('asset/js/adminhome.js') }}"></script>
</body>
</html>