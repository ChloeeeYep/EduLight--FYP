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
  <link rel="stylesheet" href="{{ URL::asset('asset/css/userapplication.css') }}">

  <!--- google font link-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>


</head>

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
        @if($applications->isEmpty())
                <div class="no-data-message">
                    <h2 class="no-data-title">No Applications Found</h2>
                    <p class="no-data-text">There are currently no scholarship applications. Start applying to scholarships available on our platform.</p>
                </div>
        @else
        <div class="scholarship-application">
            <h1 class="scholarship-title">Scholarship Applications</h1>
        </div>
        <div class="news-header">
            <div class="dropdown">
                <button class="dropbtn">
                    <i class='bx bx-filter' style="font-size:25px"></i>
                    Date <i class="fa fa-chevron-down" aria-hidden="true" style="margin-left:41px"></i>
                </button>
                <div class="dropdown-content">
                    <a href="{{ route('user.applications.filter', ['sort' => 'latest']) }}">Latest to Oldest</a>
                    <a href="{{ route('user.applications.filter', ['sort' => 'oldest']) }}">Oldest to Latest</a>
                </div>

            </div>
                <a href="{{ route('userapplication') }}" class="btn-reset">
                    <i class='bx bx-refresh'></i>
                    <span class="text">Reset</span>
                </a>
        </div>
            <div class="jobcontainer">
            @foreach ($applications as $application)
            <a href="{{ route('userscholarshipdetail', ['id' => $application->scholarship->id]) }}" class="job-card-link">
                <div class="job-card">
                      <div class="job-status">
                            @if ($application->scholarship->status == 'End')
                              <p class="job-status" style="color: red; text-align:right;">
                                <i class="fa fa-times-circle" style="color: red;"></i> Ended
                              </p>
                            @elseif ($application->scholarship->status == 'Ongoing')
                              <p class="job-status" style="color: green; text-align:right;">
                                <i class="fa fa-check-circle" style="color: green;"></i> On Going
                              </p>
                            @endif
                      </div>
                      <h2 class="job-title">{{ $application->scholarship->title ?? 'N/A' }}</h2>              
                        <p class="university-name"> {{ $application->university->username ?? 'N/A' }}</p>
                        </p>
                        <p class="status">
                          @if ($application->status == 'Accept')
                            <i class="fa fa-check-circle" aria-hidden="true"></i>
                            <span style="color: #28a745;">Application has been Accepted</span>
                          @elseif ($application->status == 'Reject')
                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                            <span style="color: red;">Application has been Rejected</span>
                          @elseif ($application->status == 'Pending')
                          <i class="fas fa-clock" aria-hidden="true"></i>
                          <span style="color: #ff9800;">Application is Pending</span>
                          @endif
                        </p>
                        <p class="application-date">
                          <i class="fa fa-calendar" aria-hidden="true"></i>
                          Applied on {{ $application->created_at->format('d M Y') }}
                        </p>
                      </div>
                    </a>
                  @endforeach
                  @endif
                  </div>
              </article>
            </main>
      <br><br><br><br><br><br><br>




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


  <!--- ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Get all the dropdown elements
        var dropdowns = document.querySelectorAll('.dropdown');

        // Add a hover event listener to each dropdown
        dropdowns.forEach(function(dropdown) {
            dropdown.addEventListener('mouseenter', function() {
                var dropdownBtn = dropdown.querySelector('.dropbtn');
                var dropdownContent = dropdown.querySelector('.dropdown-content');
                
                // Set the width of the dropdown content to match the button
                dropdownContent.style.width = `${dropdownBtn.offsetWidth}px`;
            });
        });
    });
</script>

</body>

</html>