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

  <!--- favicon-->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!--- custom css link-->
  <link rel="stylesheet" href="{{ URL::asset('asset/css/home.css') }}">
    <link rel="shortcut icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('/img/logo-header.png') }}" type="image/x-icon">
  <!--- google font link-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body id="top">

  <!--- #HEADER-->

  <header class="header" data-header>
    <div class="container">

      <a href="#" class="logo">
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
            <!-- <a href="#" style="color: #222428;">{{ Auth::user()->username }}</a> -->
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

      <!--- home-->
      <section class="section home has-bg-image" id="home" aria-label="home"
        style="background-image: url('img/home-bg.svg')">
        <div class="container">

          <div class="home-content">

            <h1 class="h1 section-title">
              The Best Platform to <span class="span">Learning</span> for Exchange
            </h1>

            <p class="home-text">
            Dedicated to empowering every student, we strive to provide accessible education for all, regardless of cost or location, unlocking learners' potential worldwide.
            </p>

            <a href="#category" class="btn has-before">
              <span class="span">Explore all</span>

              <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
            </a>

          </div>

          <figure class="home-banner">      
            <div class="img-holder one" style="--width: 270; --height: 300;">
            <img src="{{ asset('img/home-banner-1.webp') }}"  width="270" height="300" alt="home banner" class="img-cover">
            </div>

            <div class="img-holder two" style="--width: 240; --height: 370;">
            <img src="{{ asset('img/home-banner-2.jpg') }}"  width="240" height="370" alt="home banner" class="img-cover">
            </div>

            <img src="{{ asset('img/home-shape-2.png') }}" width="622" height="551" alt="" class="shape home-shape-2">

          </figure>

        </div>
      </section>





      <!-- #CATEGORY-->

      <section class="section category" aria-label="category" id="category">
        <div class="container">

          <p class="section-subtitle">Categories</p>

          <h2 class="h2 section-title">
            Online <span class="span">Resource</span> For Remote Learning.
          </h2>

          <p class="section-text">
          Explore a world of knowledge with our diverse online tutorials and quizzes designed for effective remote learning.
          </p>

          <ul class="grid-list">

            <li>
              <div class="category-card" style="--color: 170, 75%, 41%">
              
                <div class="card-icon">
                  <img src="{{ asset('img/category-1.svg') }}"  width="40" height="40" loading="lazy"
                    alt="Online Degree Programs" class="img">
                </div>

                <h3 class="h3">
                  <class="card-title">Tutorial</class>
                </h3>

                <p class="card-text">
                  Enjoy our free tutorials like other internet users 
                </p>

                <!-- <span class="card-badge">7 Courses</span> -->

              </div>
            </li>

            <li>
              <div class="category-card" style="--color: 335, 75%, 58%">

                <div class="card-icon">
                  <img src="{{ asset('img/category-3.svg') }}"  width="50" height="40" loading="lazy"
                    alt="Off-Campus Programs" class="img">
                </div>

                <h3 class="h3">
                  <class="card-title">Quiz</class>
                </h3>

                <p class="card-text">
                  Test yourself with multiple choice questions
                </p>

                <!-- <span class="card-badge">8 Courses</span> -->

              </div>
            </li>

            <li>
              <div class="category-card" style="--color: 614, 75%, 58%">

                <div class="card-icon">
                  <img src="{{ asset('img/category-2.svg') }}"  width="50" height="40" loading="lazy"
                    alt="Off-Campus Programs" class="img">
                </div>

                <h3 class="h3">
                  <class="card-title">Course</class>
                </h3>

                <p class="card-text">
                  Document your knowledge
                </p>

                <!-- <span class="card-badge">8 Courses</span> -->

              </div>
            </li>

          </ul>

          <a href="{{  route('usertutorial.type', ['type' => 'HTML'])  }}" style="margin-inline: auto;margin-block-start: 60px" class="btn has-before">
              <span class="span">Browse more</span>

              <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
          </a>
          
        </div>
      </section>

      <!--- #ABOUT-->

      <section class="section about" id="about" aria-label="about">
        <div class="container">

          <figure class="about-banner">
        
            <div class="img-holder" style="--width: 520; --height: 370;">
            <img src="{{ asset('img/about-banner.jpg') }}"  width="520" height="370" loading="lazy" alt="about banner"
                class="img-cover">
            </div>

            <img src="{{ asset('img/about-shape-1.svg') }}" width="360" height="420" loading="lazy" alt=""
              class="shape about-shape-1">

              <img src="{{ asset('img/about-shape-2.svg') }}"width="371" height="220" loading="lazy" alt=""
              class="shape about-shape-2">

              <img src="{{ asset('img/about-shape-3.png') }}" width="722" height="528" loading="lazy" alt=""
              class="shape about-shape-3">

          </figure>

          <div class="about-content">

            <p class="section-subtitle">About Us</p>

            <h2 class="h2 section-title">
              Over 10 Years in <span class="span">Distant learning</span> for Skill Development
            </h2>

            <p class="section-text">
            we have led the way in distance education, focusing on skill-building for personal and professional advancement.
            </p>

            <ul class="about-list">

            <li class="about-item">
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>

                <span class="span">Online Remote Learning</span>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>

                <span class="span">High Quality Course</span>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>

                <span class="span">Expert Trainers</span>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-done-outline" aria-hidden="true"></ion-icon>

                <span class="span">Lifetime Access</span>
              </li>

            </ul>
            
            <img src="{{ asset('img/about-shape-4.svg') }}" width="100" height="100" loading="lazy" alt=""
              class="shape about-shape-4">

          </div>

        </div>
      </section>


      <!--- #COURSE-->

      <section class="section course" id="courses" aria-label="course">
        <div class="container">

          <p class="section-subtitle">Popular Courses</p>

          <h2 class="h2 section-title">Pick A Course To Get Started</h2>

          <ul class="grid-list">
          @foreach($cours4 as $course)
            <li>
              <div class="course-card">
              <a href="{{ route('usercoursedetail', $course->id) }}">
                <figure class="card-banner img-holder" style="--width: 370; --height: 220;">
                <img src="{{ asset('images/'.$course->photo) }}" width="370" height="220" loading="lazy"
                    alt="Build Responsive Real- World Websites with HTML and CSS" class="img-cover">
                </figure>
              </a>

                <div class="abs-badge">
                  <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                  <span class="span">{{ $course->duration }} Weeks</span>
                </div>

                <div class="card-content">

                  <span class="badge">{{ $course->level }}</span>

                  <h3 class="h3">
                    <a href="{{ route('usercoursedetail' , $course->id) }}" class="card-title">{{ $course->title }}</a>
                  </h3>                

                  @if($course->price == 0)
                  <data class="price" value="29" style="color:green">FREE</data>
                  @else
                  <data class="price" value="29">RM {{ number_format($course->price, 2) }}</data>
                  @endif


                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="library-outline" aria-hidden="true"></ion-icon>

                      <span class="span">{{ $course->lesson }} Lessons</span>
                    </li>

                    <li class="card-meta-item">
                      <ion-icon name="people-outline" aria-hidden="true"></ion-icon>

                      <span class="span">{{ $enrollmentCounts[$course->id] }} Students</span>
                    </li>

                  </ul>

                </div>

              </div>
            </li>                   
            @endforeach
          </ul>

          <a href="{{ route('usercourse') }}" class="btn has-before">
            <span class="span">Browse more courses</span>

            <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
          </a>

        </div>
      </section>

      <!-- #News-->
      <section class="section blog has-bg-image" id="news" aria-label="blog">
        <div class="container">

          <p class="section-subtitle">Latest Articles</p>

          <h2 class="h2 section-title">Get News With EduLight</h2>

          <ul class="grid-list">
            @foreach($news3 as $news)
            <li>
              <div class="blog-card">

                <figure class="card-banner img-holder has-after" style="--width: 370; --height: 370;">
                  <img src="{{ asset('images/'.$news->image) }}" width="370" height="370" loading="lazy"
                    alt="Become A Better Blogger: Content Planning" class="img-cover">
                </figure>

                <div class="card-content">

                  <a href="{{ route('usernewsdetail' , $news->id) }}" class="card-btn" aria-label="read more">
                    <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                  </a>

                  <a href="{{ route('usernewsdetail' , $news->id) }}" class="card-subtitle">{{ $news->category }}</a>

                  <h3 class="h3">
                    <a href="{{ route('usernewsdetail' , $news->id) }}" class="card-title">{{ $news->title }}</a>
                  </h3>

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="calendar-outline" aria-hidden="true"></ion-icon>

                      <span class="span">{{ $news->created_at->format('Y-m-d')}}</span>
                    </li>

                  </ul>

                  <p class="card-text">
                  {{ $news->introduction }}
                  </p>

                </div>

              </div>
            </li>       
            @endforeach
          </ul>

          <a href="{{route('usernews')}}" style="margin-inline: auto;margin-block-start: 60px" class="btn has-before">
              <span class="span">Browse more</span>

              <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
          </a>

          <img src="{{ asset('img/news-shape.png') }}" width="186" height="186" loading="lazy" alt=""
            class="shape blog-shape">

        </div>
      </section>
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



  <!--- #BACK TO TOP-->

  <a href="#top" class="back-top-btn" aria-label="back top top" data-back-top-btn>
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>

  <!--- custom js link-->
  <script type="text/javascript" src="{{ URL::asset('asset/js/home.js') }}"></script>

  <!--- ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>