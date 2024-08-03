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
			<a href="{{ route('uniprofile.show') }}" class="profile">
				<i class="fas fa-user-circle"></i> <!-- Example using Font Awesome -->
			</a>
		</nav>
		<!-- NAVBAR -->
	
        <!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Scholarship</h1>
				</div>
                <form action="{{ route('searchscholarship') }}" method="GET">
                    <div class="form-input">
                        <input type="search" name="query" placeholder="Search..." value="{{ request()->query('query') }}">
                        <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
                    </div>
			    </form>

				<a href="{{route('scholarship')}}" class="btn-reset">
					<i class='bx bx-refresh'></i>
					<span class="text">Reset</span>
				</a>

                <!-- Fund Type -->
                <div class="dropdown">
                    <button class="dropbtn">
                        <i class='bx bx-filter' style="font-size:25px"></i>
                        Fund <i class="fa fa-chevron-down" aria-hidden="true" style="margin-left: 31px;"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="{{ url('/filtercscholarship?fundType=Scholarship') }}">Scholarship</a>
                        <a href="{{ url('/filtercscholarship?fundType=Education') }}">Education</a>
                        <a href="{{ url('/filtercscholarship?fundType=Loan') }}">Loan</a>
                    </div>
                </div>

                <!-- Academic Type -->
                <div class="dropdown">
                    <button class="dropbtn" style="width: 178px;">
                        <i class='bx bx-filter' style="font-size:25px"></i>
                        Academic <i class="fa fa-chevron-down" aria-hidden="true" style="margin-left: 26px;"></i>
                    </button>
                    <div class="dropdown-content" style="width: 178px;">
                        <a href="{{ url('/filtercscholarship?academic=All') }}">All</a>
                        <a href="{{ url('/filtercscholarship?academic=Foundation') }}">Foundation</a>
                        <a href="{{ url('/filtercscholarship?academic=Diploma') }}">Diploma</a>
                        <a href="{{ url('/filtercscholarship?academic=Degree') }}">Degree</a>
                    </div>
                </div>


                <!-- Status -->
                <div class="dropdown">
                    <button class="dropbtn">
                        <i class='bx bx-filter' style="font-size:25px"></i>
                        Status <i class="fa fa-chevron-down" aria-hidden="true" style="margin-left: 26px;"></i>
                    </button>
					<div class="dropdown-content">
                    <a href="{{ url('/filtercscholarship?status=Coming') }}">Coming</a>
                    <a href="{{ url('/filtercscholarship?status=Ongoing') }}">Ongoing</a>
                    <a href="{{ url('/filtercscholarship?status=End') }}">End</a>
					</div>
                </div>

			    <a href="{{route('createscholarship')}}" class="btn-add">
					<i class='bx bx-add-to-queue'></i>
					<span class="text">Add New</span>
				</a>

			</div>
            <!-- Table -->      
            @foreach ($groupedScholarships as $type => $scholarshipGroup)

            @if($groupedScholarships->isNotEmpty())
            <div class="table-data">
                <div class="order">
                    <div class="head">
                    <h3>{{$type}}</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 10%;">No.</th>
                                <th style="width: 20%;">Title</th>
                                <th style="width: 20%;">Fund Type</th>
                                <th style="width: 20%;">Academic</th>
                                <th style="width: 20%;">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $counter = 1; @endphp
                            @foreach($scholarshipGroup as $scholarship)
                                <tr>
                                    <td>{{ $counter++ }}</td>
                                    <td>{{ $scholarship->title }}</td>
									<td>{{ $scholarship->fundType }}</td>
                                    <td>{{ $scholarship->academic }}</td>
                                    <td>{{ $scholarship->status }}</td>
                                    <td>
                                        <div class="button-group">
                                            <a href="{{ route('showscholarship' , $scholarship->id) }}" class="btn-action btn-info">
                                                <i class='bx bx-bullseye'></i>
                                                <span>View</span>
                                            </a>
                                            <a href="{{ route('editscholarship' , $scholarship->id) }}" class="btn-action btn-edit">
                                                <i class='bx bx-edit-alt'></i>
                                                <span>Edit</span>
                                            </a>
                                            <!-- <form action ="{{ route('destroyscholarship' , $scholarship->id) }}" method="POST" class="form-action">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete">
                                                    <i class='bx bx-trash'></i>
                                                    <span>Delete</span>
                                                </button>
                                            </form> -->
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
</body>
</html>