
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
	width: 80%;
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
		<main>
        <div class="container">
            <div class="details-container">
                <h2>Details</h2>
                <div class="detail-group">
                    <span class="detail-label">Title:</span> 
                    <span class="detail-content">{{ $item->title }}</span>               
                </div>
				<hr>

                <div class="detail-group">
                    <span class="detail-label">Scholarship Type:</span> 
                    <span class="detail-content">{{ $item->type }}</span>               
                </div>
				<hr>

                <div class="detail-group">
                    <span class="detail-label">Fund Type:</span> 
                    <span class="detail-content">{{ $item->fundType }}</span>               
                </div>
				<hr>

                <div class="detail-group">
                    <span class="detail-label">Academic Type:</span> 
                    <span class="detail-content">{{ $item->academic }}</span>               
                </div>
				<hr>

                <div class="detail-group">
                    <span class="detail-label">Requirements:</span>
                    <textarea class="detail-content" readonly disabled>{{ $item->requirement }}</textarea>
                </div>
				<hr>

                <div class="detail-group">
                    <span class="detail-label">Description:</span>
                    <textarea class="detail-content" readonly disabled>{{ $item->description }}</textarea>
                </div>

                @if(!empty($item->website))
                <hr>
                <div class="detail-group">
                    <span class="detail-label">Website:</span>
                    <span class="detail-content">
                        <a href="{{ $item->website }}" target="_blank">{{ $item->website }}</a>
                    </span>
                </div>
                @endif

                @if(!empty($item->file))
                <hr>
				<div class="detail-group">
                    <span class="detail-label">Current File:</span>
                    <span class="detail-content">
                        <a href="{{ Storage::url($item->file) }}" target="_blank">View File</a>
                    </span>      
                </div>  
                @endif
	
				<hr>
                <div class="detail-group">
                    <span class="detail-label">Status:</span>
                    <span class="detail-content">{{ $item->status }}</span>
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