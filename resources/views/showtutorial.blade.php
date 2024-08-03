
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
	<!-- Boxicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="{{ URL::asset('asset/css/adminhome.css') }}">
	<title>Show | EduLight</title>

<style>
.container {
	font-family: Times New Roman;
    background: #fff;
    width: 90%;
    max-width: 950px;
    margin: 2rem auto;
    padding: 2rem;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.details-container {
    background: #f9f9f9;
    border-radius: 8px;
    padding: 1rem;
    border: 1px solid #ddd;
}

h2 {
    text-align: center;
    font-family: 'Poppins', sans-serif;
    color: #333;
    margin-bottom: 20px;
    font-size: 1.5rem;
}

.detail-group {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    
}

.detail-label {
    font-weight: bold;
    min-width: 100px; /* Ensures that all labels have the same width */
    display: inline-block;
    font-size: 25px;
}

.detail-group textarea{
	font-family: Times New Roman;
	width: 100%;
	padding: 10px;
	resize: none;
	line-height: 1.5;
	color: black;
	border: none;
	overflow: hidden;
	min-height: 50px;
	background-color: #f9f9f9;
	height: auto; 
	box-sizing: border-box; /* Ensure padding is included in the element's total width and height */
}

.detail-content {
    font-weight: normal;
    padding: 10px;
    font-size: 25px;
}

#content main {
	width: 100%;
	padding: 10px 10px;
	font-family: var(--poppins);
	max-height: calc(100vh - 56px);
	overflow-y: auto;
}

/* Responsive styling */
@media screen and (max-width: 768px) {
    .container {
        width: 95%;
        padding: 1rem;
    }

    .detail-label,
    .detail-content {
        font-size: 0.9rem; /* Smaller font size on smaller screens */
    }
}
</style>
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
		<main>
        <div class="container">
            <div class="details-container">
                <h2>Details</h2>
                <div class="detail-group">
                    <span class="detail-label">Type:</span> 
                    <span class="detail-content">{{ $item->type }}</span>               
                </div>
				<hr>

                <div class="detail-group">
                    <span class="detail-label">Title:</span>
                    <span class="detail-content">{{ $item->name }}</span>
                </div>
				<hr>

                <div class="detail-group">
					<span class="detail-label">Content:</span>
					<textarea class="detail-content" readonly disabled>{{ $item->details }}</textarea>
				</div>
				<hr>

				<div class="detail-group">
					<span class="detail-label">Example:</span>
					<textarea class="detail-content" readonly disabled>{{ $item->example }}</textarea>
				</div>
				<hr>


				<div class="detail-group">
                    <span class="detail-label">Question:</span>
                    <span class="detail-content">{{ $item->question }}</span>        
                </div>  
				<hr>

				<div class="detail-group">
                    <span class="detail-label">Correct Answer:</span>
                    <span class="detail-content">{{ $item->option1 }}</span>        
                </div>  
				<hr>

				<div class="detail-group">
                    <span class="detail-label">Wrong Answer:</span>
                    <span class="detail-content">{{ $item->option2 }}</span>        
                </div>  
		
            </div>
        </div>
    </section>
    </form>
	</main>

    <script type="text/javascript" src="{{ URL::asset('asset/js/adminhome.js') }}"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Select all textarea elements with the class 'detail-content'
			const textAreas = document.querySelectorAll('textarea.detail-content');

			textAreas.forEach(textArea => {
				// Set initial height based on the content
				textArea.style.height = 'auto';
				textArea.style.height = textArea.scrollHeight + 'px';

				// Adjust the height on input event
				textArea.addEventListener('input', function() {
					this.style.height = 'auto';
					this.style.height = this.scrollHeight + 'px';
				});
			});
		});
	</script>
</body>
</html>