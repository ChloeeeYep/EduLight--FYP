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
  <link rel="stylesheet" href="{{ URL::asset('asset/css/userscholarship.css') }}">

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
<style>
.hi{
    text-align: left;
    line-height: 2.5;
}
.explain{
    color:black;
    text-align: left;
}
.details{
    padding-top: 42px;
}
.scholarcontainer {
  max-width: 1200px;
  margin: auto;
  overflow: auto;
  padding: 0 20px;
}

.scholarship-explained {
  text-align: center;
}

.scholarship-explained h1 {
    font-size: 40px;
    color: black;
    margin-top: 20px;
    position: relative;
    display: inline-block;
}


.aid-type {
  background: #f8f8f8;
  padding: 20px;
  border-left: 4px solid #0056d2;
  margin: 10px 0;
}

.aid-type h3 {
  color: #0056d2;
}

.header-flex {
    display: flex;
    align-items: center; /* Centers the items vertically within the container */
    justify-content: flex-start; /* Aligns items to the start of the flex-direction, which is left by default */
}

.header-flex .back-button {
    margin-right: 354px;
    font-size: 24px;
    margin-top: 32px;
    color: black;
}

.header-flex .back-button:hover {;
    color: #0056d2;
}

ion-icon {
    vertical-align: middle; /* Aligns the icon vertically with the text */
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
                        <a href="" class="navbar-link" data-nav-link>Scholarship</a>
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
                    <a class="dropdown-item" href="">Application</a>
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

        <div class="scholarship-explained">
            <div class="scholarcontainer">
                <div class="header-flex">
                    <a href="{{route('userscholarship')}}" class="back-button" aria-label="Go back">
                        <ion-icon name="arrow-back-outline"></ion-icon>
                    </a>
                    <h1>Scholarship Explained</h1>
                </div>

                <!-- Financial Aid Providers Section -->
                <div class="details" id="financial-aid-providers">
                    <h2 class= "explain">Financial Aid Providers</h2>
                    <p class="hi">In Malaysia, the sponsors of financial aid come from various categories. These include scholarships and loans offered by the government, non-governmental organisations, the private sector, government-linked companies, and trade associations.</p>
                </div>
                
                <!-- Types of Financial Aid Section -->
                <div class="details" id="types-of-financial-aid">
                    <h2  class= "explain">Types of Financial Aid</h2>
                    <p class="hi">Higher education is one of the most important investments you will make in your lifetime. With the increasing cost of education, planning ahead is essential to finance your education. So what are some options you can explore?</p>
                
                    <div class="aid-type" id="scholarships">
                        <h3>Scholarships</h3>
                        <p>Scholarships are monetary awards given based on academic or other achievements and are non-repayable, which means you won't have to pay the money back. Scholarships are awarded by the government, non-government organisations, corporations and independent foundations.</p>
                    </div>
                    
                    <div class="aid-type" id="bursaries">
                        <h3>Bursaries</h3>
                        <p>You may have heard people using the terms 'scholarship' and 'bursary' interchangeably, however, bursaries are usually non-competitive and automatic, and often based on financial need without emphasis on academic standing.</p>
                    </div>

                    <div class="aid-type" id="grants">
                        <h3>Grants</h3>
                        <p>Grants are similar to scholarships and also don't have to be repaid. The difference is that grants are often need-based while scholarships are usually merit-based. Grants are also given to students who carry out academic research projects.</p>
                    </div>

                    <div class="aid-type" id="education">
                        <h3>Education Funds</h3>
                        <p>Education Funds are Scholarships or loans provided by the Government / foundation / private educational institutions / financial institutions to reduce the burden of financing a student's education expenses, whether locally or overseas.</p>
                    </div>

                    <div class="aid-type" id="tuition">
                        <h3>Tuition Fee Waiver or Discount</h3>
                        <p>Many private higher education institutions in Malaysia offer partial or full tuition fee waivers or discounts based on merit (e.g. academic, sports, leadership roles). Recipients are often required to maintain a minimum CGPA to continue enjoying the tuition fee waiver.</p>
                    </div>

                    <div class="aid-type" id="unit ">
                        <h3>Unit Trusts & Insurance Schemes</h3>
                        <p>These are typically investment schemes that parents undertake for several years to secure financial funding for their child's higher education.</p>
                    </div>

                    <div class="aid-type" id="loans ">
                        <h3>Loans</h3>
                        <p>Loans are financial obligations that must be repaid. Loans are mostly provided by private sector or government bodies.</p>
                    </div>
                </div>
                
                <!-- Financing for Higher Education Section -->
                <div class="details" id="financing-education">
                <h2  class= "explain">Financing for Higher Education</h2>
                <p class="hi">The cost of tertiary education does not come cheap, but it is a lifetime investment for your future. Therefore whether your parents can afford your entire or partial cost of tertiary education, you are advised to go through this pathway in order to be competitive in your career advancement. If your family cannot afford the cost, you may work while studying part-time or look for some forms of scholarship, study grant, loan or other sources of financial aid to help you to pay for your education.</p>
                </div>
            </div>
        </div>
        </article>
      </main>
      <br><br><br><br>





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
