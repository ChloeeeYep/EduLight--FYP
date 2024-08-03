<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!--- primary meta tag-->
  <title>EduLight</title>
  <meta name="title" content="EduLight - The Best Program to Enroll for Exchange">
  <meta name="description" content="This is an education html template made by codewithsadee">

  <link rel="shortcut icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
  <!--- custom css link-->
  <link rel="stylesheet" href="{{ URL::asset('asset/css/coursedetailpurchase.css') }}">

  <!--- google font link-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css">


</head>
<style>
  div:where(.swal2-container) div:where(.swal2-popup) {
    font-size: 15PX !important;
  }
</style>

<body id="top">

  <!--- #HEADER-->

    <header class="header" >
        <div class="container" style="padding-inline: 16px">

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
        <div class="edu-breadcrumb-area breadcrumb-style-3">
            <div class="container">
            <a href="{{route('userorder')}}" class="back-button">
              <ion-icon name="arrow-back-outline"></ion-icon>
            </a>
                    <div class="page-title">
                        <h1 class="title">{{ $item->title }}</h1>
                    </div>
                    <ul class="course-meta">
                      <li class="course-meta-item">
                        <span class="meta-wrapper">
                          <i class="fa fa-chalkboard-teacher"></i>
                          <span>by {{ $instructorName  }}</span>
                        </span>
                        <span class="meta-divider">|</span>
                        <span class="meta-wrapper">
                          <i class="fa fa-language"></i>
                          <span>{{ $item->language }}</span>
                        </span>
                      </li>
                    </ul>
                </div>
            </div>
        </div>

        <!--=====================================-->
        <!--=     Courses Details Area Start    =-->
        <!--=====================================-->
        <section class="edu-section-gap course-details-area">
            <div class="container">
                <div class="row row--30">
                    <div class="col-lg-8">
                        <div class="course-details-content">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Curriculum</button>
                                </li>                           
                            </ul>                      
                            <p class="name" style="display:none;">{{ $item->title }}</p>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                    <div class="course-tab-content">
                                        <div class="course-overview">
                                            <h3 class="heading-title">Course Curriculum</h3>
                                            <div class="curriculum-container">
                                              <div class="week-section">
                                                  <h4 class="week-title">Week 1-{{ $item->duration }}</h4>
                                                  <p class="week-description"></p>
                                                  @foreach ($videos as $video)
                                                    <ul class="curriculum-list">
                                                      <a href="{{ Storage::url($video->video) }}" target="_blank">
                                                        <li class="curriculum-item">
                                                            <i class='bx bx-video' style="font-size: 20px;"></i>{{$video->session}}                                         
                                                            <i class='bx bx-lock-open-alt' style="font-size: 19px;"></i>
                                                        </li>        
                                                      </a>                
                                                    </ul>
                                                  @endforeach
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                                                                        
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="course-sidebar-3 sidebar-top-position">
                              <div class="edu-course-widget widget-course-summery">
                                  <div class="inner">
                                      <div class="course-media">
                                        <img src="/images/{{ $item->photo }}"  class="course-image">
                                      </div>
                                      <div class="content">
                                      <h3 class="course-include">Course Includes:</h3>
                                          <div class="course-info">
                                          @if($item->price == 0)
                                          <p><i class="fa-solid fa-money-bill-wave"></i><span class="info-title">Price:</span> <span class="info" style="color: green; font-weight: 600; font-size: 18px;">FREE</span></p>
                                            <hr>
                                          @else
                                            <p><i class="fa-solid fa-money-bill-wave"></i><span class="info-title">Price:</span> <span class="info" style="color: var(--radical-red); font-weight: 600; font-size: 18px;">RM {{ $item->price }}</span></p>
                                            <hr>
                                          @endif                                     
                                            <p><i class="fa fa-chalkboard-teacher"></i><span class="info-title">Instructor:</span> <span class="info">{{ $instructorName  }}</span></p>
                                            <hr>
                                            <p><i class="fa fa-clock"></i><span class="info-title">Duration:</span> <span class="info">{{ $item->duration }} Weeks</span></p>
                                            <hr>
                                            <p><i class="fa fa-book"></i><span class="info-title">Lessons:</span> <span class="info">{{ $item->lesson }}<span></p>
                                            <hr>
                                            <p><i class="fa fa-users"></i><span class="info-title">Enrolled:</span> <span class="info">{{ $enrollmentCount }}</span></p>
                                            <hr>                                   
                                            <p><i class="fa fa-star"></i><span class="info-title">Level:</span> <span class="info">{{ $item->level }}</span></p>
                                            <hr>
                                            <p><i class="fa fa-language"></i><span class="info-title">Language:</span> <span class="info">{{ $item->language }}</span></p>
                                          </div>                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </section>    
        </article>
      </main>
<br><br>




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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!--- ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function () {
          @if(session('cart_add_error'))
              Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: '{{ session('cart_add_error') }}',
              });
          @endif

          @if(session('cart_add_success'))
              Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: '{{ session('cart_add_success') }}',
              });
          @endif
      });
  </script>

<script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@6/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@6/dist/ionicons/ionicons.js"></script>

</body>

</html>