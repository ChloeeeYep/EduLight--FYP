<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<!-- My CSS -->
	<link rel="stylesheet" href="{{ URL::asset('asset/css/adminhome.css') }}">
	<link rel="shortcut icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
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
			<li class="active">
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
				<a href="{{ route('export.orders.csv') }}" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download CSV</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bx-clipboard'></i>
					<span class="text">
						<h3>{{ $totalOrders }}</h3>
						<p>Order</p>
					</span>
				</li>
				<li>
					<i class='bx bx-library'></i>
					<span class="text">
						<h3>{{ $totalOrderItems }}</h3>
						<p>Courses</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle'></i>
					<span class="text">
						<h3>RM {{ $totalSales }}</h3>
						<p>Total Sales</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Orders</h3>
						<!-- <i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i> -->
					</div>
					<table>
						<thead>
							<tr>
							    <th style="width: 10%;">No.</th>
								<th style="width: 10%;">User</th>
								<th style="width: 50%;">Course Name</th>
								<th style="width: 10%;">Payment Method</th>
								<th style="width: 10%;">Date Purchase</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($orders as $order)
								<tr>
									<td>{{ $loop->index + 1 }}</td>
									<td>{{ $order->name }}</td>
									<td>
										@if($order->orderItems->count() == 1)
											<a href="{{ route('adminorderdetail', $order->id) }}">{{ $order->orderItems->first()->name }}</a>
										@else
											{{ $order->orderItems->first()->name }}
											@if($order->orderItems->count() > 1)
												<a href="{{ route('adminorderdetail', $order->id) }}">+ {{ $order->orderItems->count() - 1 }} more</a>
											@endif
										@endif
									</td>
									<td>{{ $order->paymentMethod }}</td>
									<td>{{ $order->created_at->format('n/j/Y') }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				<div class="todo">
					<div class="head">
						<h3>Top 5 Courses</h3>
					</div>
					<ul class="todo-list">
						@foreach ($topCourses as $course)
							<li class="">
								<a href="{{ route('showcourse', ['item' => $course->courseId]) }}"> 
									<p class="course-name">{{ $course->name }}</p>
								</a>
									<span>Total Purchase: {{ $course->totalPurchases }}</span>
							</li>
						@endforeach
					</ul>
				</div>
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