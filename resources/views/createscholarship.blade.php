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
	<title>Scholarship | EduLight</title>
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
			<li>
                <a href="{{ route('unihome') }}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
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
			<a href="" class="profile">
				<i class="fas fa-user-circle"></i> <!-- Example using Font Awesome -->
			</a>
		</nav>
		<!-- NAVBAR -->
	
        <!-- MAIN -->
		    <main>
                <form action="{{route('storescholarship')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container">
                        <div class="form-container">
                            <h2>Add New Scholarship</h2>
                            <form>
                                <div class="form-group">
                                    <label for="title">Title<span class="optional">*</span></label>
                                    <input type="text" id="title" name="title" maxlength="250" required>
                                </div>

                                <div class="form-group">
                                        <label for="type">Scholarship Type<span class="optional">*</span></label>
                                        <select id="type" name="type" required>
                                            <option value="All">All</option>
                                            <option value="Result">Result</option>
                                            <option value="Sport">Sport</option>
                                        </select>
                                </div>

                                <div class="form-group">
                                        <label for="fundType">Fund Type<span class="optional">*</span></label>
                                        <select id="fundType" name="fundType" required>
                                            <option value="" selected>Select Fund Type</option>
                                            <option value="Scholarship">Scholarship</option>
                                            <option value="Education">Education Funds</option>
                                            <option value="Loan">Loan</option>
                                        </select>
                                </div>

                                <div class="form-group">
                                        <label for="academic">Academic Type<span class="optional">*</span></label>
                                        <select id="academic" name="academic" required>
                                            <option value="All">All</option>
                                            <option value="Foundation">Foundation</option>
                                            <option value="Diploma">Diploma</option>
                                            <option value="Degree">Bachelor's Degree</option>
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label for="requirement">Requirements<span class="optional">*</span></label>
                                    <textarea id="requirement" name="requirement" rows="4" required></textarea>
                                </div>  
                                
                                <div class="form-group">
                                    <label for="description">Description<span class="optional">*</span></label>
                                    <textarea id="description" name="description" rows="4" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="text" id="website" name="website" >
                                </div> 

                                <div class="form-group">
                                    <label for="file">Details File</label>
                                    <input type="file" class="form-control-file" name="file">
                                </div>

                                <div class="form-group">
                                        <label for="status">Status<span class="optional">*</span></label>
                                        <select id="status" name="status">
                                            <option value="Coming">Coming Soon</option>
                                            <option Selected value="Ongoing">On going</option>
                                        </select>
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