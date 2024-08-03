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
<style>
	.order-tracking-container {
    max-width: 770px;
    margin: auto;
}

.order-item-link {
    text-decoration: none; /* Removes the underline from the link */
    color: inherit; /* Keeps the text color consistent with the rest of the design */
    display: block; /* Makes the link block level to fill the container */
}

.order-item-link:hover {
    color:black;
}

.order-card {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 5px;
    margin-top: 35px;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}


.order-body {
    margin-bottom: 10px;
}

.order-item {
    display: flex; /* Updated to flex */
    align-items: center;
    margin-bottom: 10px;
    padding: 10px;
    background-color: #ffffff;
    box-shadow: 0px 2px 4px rgba(0,0,0,0.1);
    border-radius: 8px;
    justify-content: space-between; /* This will align children on both ends */
}

.item-name-and-price {
    display: flex;
    justify-content: space-between; /* Keeps items on opposite ends */
    align-items: center;
    width: 100%; /* Takes the full width of its container */
    height: 60px;
}

.item-name {
    overflow: hidden; /* Hide overflow */
    text-overflow: ellipsis; /* Add an ellipsis for overflow */
    max-width: calc(100% - 100px); /* Adjust the max-width as necessary */
    font-weight: 500;
}

.item-price {
    min-width: 100px; /* Ensure the price box does not shrink */
    text-align: right; /* Align the price text to the right */
    margin-left: auto; /* Pushes the price to the right */
    font-weight: 500;
}

.payment-method {
    text-align: right;
    font-size: 15px;
    padding-top: 10px;
    border-top: 1px solid #ddd;
}

.order-total {
    font-size: 15px;
    border-top: 1px solid #ddd;
    margin-top: 10px;
    font-weight: bold;
    text-align: right;
    color: rgb(238, 77, 45)
}
</style>

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
					<h1>Order Details</h1>
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
				<!-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download CSV</span>
				</a> -->
			</div>

			<div class="order-tracking-container">
                    <div class="order-card">
                        <div class="order-header">
                            <h2>Purchase# {{ $order->id }}</h2>
                            <h2 class="date" style="font-size:20px">Purchase Date: {{ $order->created_at->format('n/j/Y') }}</h2>
                        </div>
                        <div class="order-body">
                            <h3>Courses:</h3>
                            @foreach ($order->orderItems as $index => $item)
                              <a href="{{ route('showcourse', ['item' => $item->courseId]) }}" class="order-item-link">
                                    <div class="order-item">
                                        <div class="item-name-and-price">
                                            <div class="item-name">{{ $index + 1 }}. {{ $item->name }}</div>
                                            <div class="item-price">RM {{ $item->price }}</div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                            <div class="order-total">
                                Total Price: RM {{ $order->total }}
                            </div>
                            <div class="payment-method">
                                Payment Method: {{ $order->paymentMethod }}
                            </div>
                        </div>
                    </div>
            </div>				
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
    <script type="text/javascript" src="{{ URL::asset('asset/js/adminhome.js') }}"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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