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
      <i class='bx bxs-school'></i>
			<span class="text">Univeristy</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
                <a href="{{ route('unihome') }}">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
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
			<div class="mt-5">
        </div>
        <form action="{{ route('applicants.update.status', $applicant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
			<div class="container">
				<div class="form-container">
					<h2>Edit Application</h2>
					<form>
                        <div class="form-group">
                          <label for="title">Scholarship Title</label>
                          <input type="text" id="title" name="title" value="{{ $scholarshipTitle}}" readonly disabled>
                        </div>

                        <div class="form-group">
                          <label for="name">Full Name</label>
                          <input type="text" id="name" name="name" value="{{ $applicant->name }}" readonly disabled>
                        </div>

                        <div class="form-group">
                              <label for="gender">Gender</label>
                              <input type="text" id="gender" name="gender" value="{{ $applicant->gender }}" readonly disabled>
                          </div>

                          <div class="form-group">
                              <label for="birthday">Birthday</label>
                              <input type="text" id="birthday" name="birthday" value="{{ $applicant->birthday }}" readonly disabled>
                          </div>

                        
                          <div class="form-group">
                            <label for="nric">NRIC No.</label>
                            <input type="text" id="nric" name="nric" value="{{ $applicant->nric }}" readonly disabled>
                          </div>

                          <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="{{ $applicant->email }}" readonly disabled>
                          </div>

                          <div class="form-group">
                            <label for="home">Home Address</label>
                            <input type="text" id="home" name="home" value="{{ $applicant->address }}" readonly disabled>
                          </div>

                          <div class="form-group">
                            <label for="contact">Contact Number</label>
                            <input type="text" id="contact" name="contact" value="{{ $applicant->contact }}" readonly disabled>
                          </div>

                          <div class="form-group">
                              <label for="course">Course(s) interested</label>
                              <input type="text" id="course" name="course" value="{{ $applicant->course }}" readonly disabled>
                          </div>

                          <div class="form-group">
                              <label for="qualification">Current Qualification<span class="optional">*</span></label>
                              <input type="text" id="qualification" name="qualification" value="{{ $applicant->qualification }}" readonly disabled>
                          </div>

                          <div class="form-group">
                            <label for="file">Transcripts</label>
                            <div class="testtest">
                                Current File:
                                @if($applicant->file)
                                  <a href="{{ Storage::url($applicant->file) }}" target="_blank">View File</a>
                                @else
                                    No file uploaded.
                                @endif
                            </div>
                          </div>

                        <div class="form-group">
                            <label for="status">Status<span class="optional">*</span></label>
                            <select id="status" name="status">
                                <option value="Pending" {{ $applicant->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Accept" {{ $applicant->status === 'Accept' ? 'selected' : '' }}>Accept</option>
                                <option value="Reject" {{ $applicant->status === 'Reject' ? 'selected' : '' }}>Reject</option>
                            </select>
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