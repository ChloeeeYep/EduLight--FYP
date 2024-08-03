<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
  <!--- primary meta tag-->
  <title>EduLight</title>
  <meta name="title" content="EduLight - The Best Program to Enroll for Exchange">
  <meta name="description" content="This is an education html template made by codewithsadee">


  <!--- custom css link-->
  <link rel="stylesheet" href="{{ URL::asset('asset/css/userscholarshipdetail.css') }}">

  <!--- google font link-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>
<style>
  div:where(.swal2-container) div:where(.swal2-popup) {
    font-size: 15PX !important;
  }
</style>
<body id="top">

  <!--- #HEADER-->

    <header class="header" >
        <div class="container">

            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('img/logo.svg') }}" width="162" height="50" alt="EduLight logo">
            </a>

            <nav class="navbar" data-navbar>

                <div class="wrapper">
                <a href="#" class="logo">
                    <img src="{{ asset('img/logo.svg') }}" width="162" height="50" alt="EduLight logo">
                </a>

                <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
                    <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                </button>
                </div>

                <ul class="navbar-list">

                <ul class="navbar-list">
                  <li class="navbar-item">
                    <a href="{{ route('usertutorial.type', ['type' => 'HTML']) }}" class="navbar-link" data-nav-link>Tutorial</a>
                    <!-- <ul class="dropdown-menu">
                      <li><a href="{{ route('usertutorial.type', ['type' => 'HTML']) }}" class="dropdown-item">Tutorial</a></li>
                      <li><a href="{{  route('userquizbrief.type', ['type' => 'HTML'])  }}" class="dropdown-item">Quiz</a></li>
                    </ul> -->
                  </li>

                  <li class="navbar-item">
                    <a href="{{ route('userquizbrief.type', ['type' => 'HTML'])  }}" class="navbar-link" data-nav-link>Quiz</a>
                  </li>

                <li class="navbar-item">
                    <a href="{{ route('usercourse') }}" class="navbar-link" data-nav-link>Courses</a>
                </li>

                <li class="navbar-item">
                    <a href="{{ route('usernews') }}" class="navbar-link" data-nav-link>News</a>
                </li>

                <li class="navbar-item">
                  <a href="{{ route('userscholarship') }}" class="navbar-link" data-nav-link>Scholarship</a>
                </li>   

                </ul>

            </nav>

            <div class="header-actions">
              <!-- 
              <button class="header-action-btn" aria-label="toggle search" title="Search">
                <ion-icon name="search-outline" aria-hidden="true"></ion-icon>
              </button> -->
              @if(Auth::check())
              <a href="{{ route('cart') }}" title="Cart" class="header-action-btn">
                <ion-icon name="cart-outline" aria-hidden="true"></ion-icon>
              </a>
                <!-- <a href="#" style="color: #222428;">{{ Auth::user()->name }}</a> -->
                <div class="navbar-item">
                  <button class="header-action-btn">
                    <i class="fa-regular fa-user" style="font-size:20px"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{route('profile.show')}}">Profile</a>
                    <a class="dropdown-item" href="{{route('userorder')}}">My Courses</a>
                    <a class="dropdown-item" href="{{ route('userapplication') }}">Application</a>
                  </div>
                </div>

                <a href="{{route('logout')}}" title="Cart" class="header-action-btn">
                    <i class="fa fa-sign-out" style="font-size:20px;color:red" ></i>
                </a>
              @else
                <a href="{{ route('signin') }}" style="color: #0056d2;">
                  <span class="span">Sign in</span>
                </a>
                <a href="{{ route('signup') }}" class="btn has-before">
                  <span class="span">Sign Up For Free</span>
                </a>
              @endif
              <button class="header-action-btn" aria-label="open menu" data-nav-toggler>
                <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
              </button>

            </div>

            <div class="overlay" data-nav-toggler data-overlay></div>

        </div>
    </header>
    <main>
        <article>
            <div class="scholarship-container">
                <a href="{{route('userscholarship')}}" class="back-link">
                    <ion-icon name="arrow-back-outline"></ion-icon>
                </a>
                <div class="scholarship-detail">
                    <h2 class="scholarship-name">{{ $item->title }}</h2> 
                    <div class="scholarship-info">
                        <strong>Status:</strong>
                        <span class="info-value {{ strtolower($item->status) }}">
                            {{ $item->status }}
                        </span>
                    </div>
                    <div class="scholarship-info">
                        <strong>University:</strong>
                        <span class="info-value">{{ $item->user->username ?? 'N/A' }}</span>
                    </div>
                    <div class="scholarship-info">
                        <strong>Scholarship Type:</strong>
                        You can use <span class="info-value">{{ $item->type == 'All' ? 'Sport / Result' : $item->type }}</span> to apply
                    </div>
                    <div class="scholarship-info">
                        <strong>Academic Type:</strong>
                        <span class="info-value">
                            {{ $item->academic == 'All' ? 'Foundation / Diploma / Degree' : $item->academic }}
                        </span>
                    </div>
                    <div class="scholarship-info">
                        <strong>Fund Type:</strong>
                        <span class="info-value">{{ $item->fundType }}</span>
                    </div>

                    @if (!empty($item->website) || !empty($item->file))
                        <div class="scholarship-info">
                            <strong>Scholarship Guide:</strong>
                            @if ($item->website)
                                <span class="info-value"><a href="{{ $item->website }}" target="_blank">Website</a></span>
                            @endif

                            @if (!empty($item->website) && !empty($item->file))
                                /
                            @endif

                            @if(!empty($item->file))
                                <span class="info-value"><a href="{{ Storage::url($item->file) }}" target="_blank">File</a></span>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="scholarship-explain">
                    <h3 class="academic-heading">Requirement</h3>
                    <textarea class="detail-content" readonly disabled>{{ $item->requirement }}</textarea>
                </div>

                <div class="scholarship-explain">
                    <h3 class="academic-heading">Description</h3>
                    <textarea class="detail-content" readonly disabled>{{ $item->description }}</textarea>
                </div>
                @if(Auth::check())  
                  @if (strtolower($item->status) !== 'end' && strtolower($item->status) !== 'coming')
                      <button class="apply-button">Apply</button>
                  @endif
                @else
                    <button class="apply-button">Apply</button>
                @endif
            </div>

      @include('scholarshipapply')        
        </article>
    </main>





<!--- #FOOTER-->

<footer class="footer" style="background-image: url('img/footer-bg.png')">

<div class="footer-top section">
  <div class="container grid-list">

    <div class="footer-brand">

      <a href="#" class="logo">
      <img src="{{ asset('img/logo-light.svg') }}" width="162" height="50" alt="EduLight logo">
      </a>

      <p class="footer-brand-text">
         Dedicated to empowering every student, we strive to provide accessible education for all, regardless of cost or location, unlocking learners' potential worldwide.
      </p>

      <div class="wrapper">
        <span class="span">Address:</span>

        <address class="address">Jalan Teknologi 5, Taman Teknologi Malaysia, 57000 Kuala Lumpur, Malaysia</address>
      </div>

      <div class="wrapper">
        <span class="span">Phpne:</span>

        <class="footer-link">60 123 4567 89</class>
      </div>

      <div class="wrapper">
        <span class="span">Email:</span>

        <a href="mailto:info@edulight.com" class="footer-link">info@edulight.com</a>
      </div>

    </div>

    <ul class="footer-list">

      <li>
        <p class="footer-list-title">Learning Platform</p>
      </li>

      <li>
        <a href="{{ route('usertutorial.type', ['type' => 'HTML']) }}" class="footer-link">Tutorial</a>
      </li>

      <li>
        <a href="{{ route('usercourse') }}" class="footer-link">Courses</a>
      </li>

      <li>
        <a href="{{ route('userquizbrief.type', ['type' => 'HTML'])  }}" class="footer-link">Quiz</a>
      </li>
   

    </ul>

    <ul class="footer-list">

      <li>
        <p class="footer-list-title">Links</p>
      </li>

      <li>
        <a href="{{route('userscholarship')}}" class="footer-link">Scholarship</a>
      </li>

      <li>
        <a href="{{ route('usernews') }}" class="footer-link">News & Articles</a>
      </li>

      <li>
        <a href="{{ route('typing') }}" target="_blank" class="footer-link">Typing Practice</a>
      </li>

    </ul>

    <div class="footer-list">

      <p class="footer-list-title">Contacts</p>

      <p class="footer-list-text" style="margin-bottom:10px">
      <p>We appreciate your feedback! Please feel free to reach out to us via <a href="mailto:CustomerServic@edulight.com" class="footer-link" style="display: inline;">email</a>.</p>
      </p>

      <ul class="social-list" style="margin-top: 10px;">

        <li>
          <a href="#" class="social-link">
            <ion-icon name="logo-facebook"></ion-icon>
          </a>
        </li>

        <li>
          <a href="#" class="social-link">
            <ion-icon name="logo-linkedin"></ion-icon>
          </a>
        </li>

        <li>
          <a href="#" class="social-link">
            <ion-icon name="logo-instagram"></ion-icon>
          </a>
        </li>

        <li>
          <a href="#" class="social-link">
            <ion-icon name="logo-twitter"></ion-icon>
          </a>
        </li>

        <li>
          <a href="#" class="social-link">
            <ion-icon name="logo-youtube"></ion-icon>
          </a>
        </li>

      </ul>

    </div>

  </div>
</div>

<div class="footer-bottom">
  <div class="container">

    <p class="copyright">
      Copyright 2024 All Rights Reserved by <a href="#" class="copyright-link">EduLight</a>
    </p>

  </div>
</div>

</footer>

  <!--- custom js link-->
  <script type="text/javascript" src="{{ URL::asset('asset/js/home.js') }}"></script>

  <!--- ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const addToCartBtn = document.querySelector('.apply-button');
        if(addToCartBtn) {
            addToCartBtn.addEventListener('click', function(event) {
                @if(Auth::check())
                    // If authenticated, allow adding to cart
                    return true;
                @else
                    // If not authenticated, prevent default action (adding to cart)
                    event.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please Log In to Apply the Scholarship.'
                    }).then((result) => {
                        if (result.isConfirmed || result.isDismissed) {
                            window.location.href = "{{ route('signin') }}";
                        }
                    });
                @endif
            });
        }
    });
</script>

  <script>
      document.querySelector('.apply-button').addEventListener('click', function() {
          document.getElementById('pageOverlay').style.display = 'block'; // Show the overlay
          document.getElementById('popupForm').style.display = 'flex'; // Show the popup form
      });

      function closeForm() {
          document.getElementById('pageOverlay').style.display = 'none'; // Hide the overlay
          document.getElementById('popupForm').style.display = 'none'; // Hide the popup form
      }

      // Optionally close the form when the overlay is clicked
      document.getElementById('pageOverlay').addEventListener('click', function() {
          closeForm();
      });
  </script>

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
        @if ($errors->any())
            var errorMessage = '';
            @foreach ($errors->all() as $error)
                errorMessage += '{{ $error }}\n';
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: errorMessage,
                allowOutsideClick: false, // Prevent dismissing the alert by clicking outside
                allowEscapeKey: false, // Prevent dismissing the alert by pressing Esc key
            });
        @endif

		document.getElementById('contact').addEventListener('input', function(event) {
            var phoneInput = event.target.value;
			if (!/^\d*\.?\d*$/.test(phoneInput)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid contact',
                    text: 'Please enter numeric values only.',
                });
                event.target.value = ''; // Clear the input field
            }
        });

      document.getElementById('nric').addEventListener('input', function(event) {
          var nricInput = event.target.value;
      if (!/^\d*\.?\d*$/.test(nricInput)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid NRIC',
                    text: 'Please enter numeric values only.',
                });
                event.target.value = ''; // Clear the input field
            }
        });

    });
</script>

</body>

</html>