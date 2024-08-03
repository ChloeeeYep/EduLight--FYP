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
  <link rel="stylesheet" href="{{ URL::asset('asset/css/usertutorial.css') }}">

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

      <nav class="additional-nav">
          <div class="container">
              <ul class="additional-nav-list">
                  @foreach ($uniqueTypes as $type)
                      @php
                          $typeSlug = Str::slug($type);
                      @endphp
                      <li><a href="{{ route('usertutorial.type', $typeSlug) }}">{{ $type }}</a></li>
                  @endforeach
              </ul>
          </div>
      </nav>


      <aside class="sidebar">
        <nav class="sidebar-nav">
          <ul class="sidebar-list">
            @isset($selectedType)
              <div class="title">
                  <b>{{ $selectedType }} Tutorials</b>
              </div>
              @foreach ($tutorials as $tutorial)
                @if($tutorial->type === $selectedType)
                @php
                    $typeSlug = Str::slug($type);
                @endphp
                <a href="javascript:void(0);" data-tutorial-id="{{ $tutorial->id }}" onclick="showArticle('{{ $tutorial->id }}', false, this)">{{ $tutorial->name }}</a>
                <!-- <a href="{{ route('usertutorial.showByTypeAndId', ['type' => Str::slug($tutorial->type), 'id' => $tutorial->id]) }}" onclick="showArticle({{ $tutorial->id }})">{{ $tutorial->name }}</a> -->
                @endif
              @endforeach
            @endisset
          </ul>
        </nav>
      </aside>


      <div class="main-content">
        @foreach ($tutorials as $tutorial)
        <article id="article-{{ $tutorial->id }}" style="display: none;">
          <section class="section category" aria-label="category" id="category">
            <div class="container">
              <h2 class="h2 section-title">
                {{ $tutorial->name }}
              </h2>
              <hr>

              <textarea class="section-text" readonly disabled oninput="adjustTextareaHeight(this)">{{ $tutorial->details }}</textarea>

              <div class="example-container">
                <h2>Example</h2></h1>*Copy the code and paste it</h1>
                <div class="try">
                  <textarea id="demo" class="example-textarea" readonly disabled oninput="adjustTextareaHeight(this)">{{ $tutorial->example }}</textarea>
                </div>
                <a href="{{ route('texteditor') }}" target="_blank" style="margin-inline: auto;margin-block-start: 20px;" class="btn has-before">
                  <span class="span">try it yourself</span>
                  <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                </a>
              </div>

              <br><br>
              <div id="wrapper">
                <h2 class="quiz-title">Question</h2>
                <div id="quiz-container">
                  <div id="question" class="question">{{ $tutorial->question }}</div>
                  <ul id="options" class="options">
                    <li><button class="option" data-correct-answer>{{ $tutorial->option1 }}</button></li>
                    <li><button class="option">{{ $tutorial->option2 }}</button></li>
                  </ul>
                  <div class="feedback"></div>
                </div>
              </div>
            </div>
          </section>
        </article>
        @endforeach
      </div>






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
  <script type="text/javascript" src="{{ URL::asset('asset/js/usertutorial.js') }}"></script>

  <!--- ionicon link-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>