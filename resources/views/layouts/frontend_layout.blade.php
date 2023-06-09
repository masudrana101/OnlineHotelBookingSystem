<!doctype html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Hotel</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="manifest" href="">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/frontend/assets/img/favicon.ico') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- CSS here -->
  <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/owl.carousel.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/gijgo.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/slicknav.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/animate.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/magnific-popup.css') }}x">
  <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/fontawesome-all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/themify-icons.min.css') }}x">
  <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/nice-select.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/frontend/assets/css/responsive.css') }}">
  @yield('stylesheet')
</head>
<body>
<!-- Preloader Start -->
<div id="preloader-active">
  <div class="preloader d-flex align-items-center justify-content-center">
    <div class="preloader-inner position-relative">
      <div class="preloader-circle"></div>
      <div class="preloader-img pere-text">
        <strong>Hotel</strong>
      </div>
    </div>
  </div>
</div>
<!-- Preloader Start -->
<header>
  <!-- Header Start -->
  <div class="header-area header-sticky">
    <div class="main-header ">
      <div class="container">
        <div class="row align-items-center">
          <!-- logo -->
          <div class="col-xl-2 col-lg-2">
            <div class="logo">
              <a href="{{ route('home') }}"><img src="{{ asset('assets/frontend/assets/img/logo/logo.png') }}"
                                                 alt=""></a>
            </div>
          </div>
          <div class="col-xl-8 col-lg-8">
            <!-- main-menu -->
            <div class="main-menu f-right d-none d-lg-block">
              <nav>
                <ul id="navigation">
                  <li><a href="{{ route('home') }}">Home</a></li>
                  <li><a href="{{ route('hotel.hotel-list') }}">Hotel</a></li>
                  <li><a href="{{ route('hotel.contact') }}">Contact</a></li>
                  @if(Auth::user())
                    @if(Auth::user()->type === 'admin')
                      <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                      <li><a href="{{ route('admin.logout') }}">Logout</a></li>
                    @else
                      <li><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                      <li><a href="{{ route('customer.logout') }}">Logout</a></li>
                    @endif
                  @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                  @endif
                </ul>
              </nav>
            </div>
          </div>
        {{--<div class="col-xl-2 col-lg-2">--}}
        {{--<!-- header-btn -->--}}
        {{--<div class="header-btn">--}}
        {{--<a href="#" class="btn btn1 d-none d-lg-block ">Book Online</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        <!-- Mobile Menu -->
          <div class="col-12">
            <div class="mobile_menu d-block d-lg-none"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Header End -->
</header>

<main>
  @yield('content')

</main>
<footer>
  <!-- Footer Start-->
  <div class="footer-area black-bg footer-padding">
    <div class="container">
      <div class="row d-flex justify-content-between">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
          <div class="single-footer-caption mb-30">
            <!-- logo -->
            <div class="footer-logo">
              <a href="{{ route('home') }}"><img src="{{ asset('assets/frontend/assets/img/logo/logo2_footer.png') }}"
                                                 alt=""></a>
            </div>
            <div class="footer-social footer-social2">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
              <a href="#"><i class="fas fa-globe"></i></a>
              <a href="#"><i class="fab fa-behance"></i></a>
            </div>
            <div class="footer-pera">
              <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright &copy;<script>document.write(new Date().getFullYear());</script>

                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-5">
          <div class="single-footer-caption mb-30">
            <div class="footer-tittle">
              <h4>Quick Links</h4>
              <ul>
                <li><a href="#">About Mariana</a></li>
                <li><a href="#">Our Best Rooms</a></li>
                <li><a href="#">Our Photo Gellary</a></li>
                <li><a href="#">Pool Service</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
          <div class="single-footer-caption mb-30">
            <div class="footer-tittle">
              <h4>Reservations</h4>
              <ul>
                <li><a href="#">Tel: 345 5667 889</a></li>
                <li><a href="#">Skype: Marianabooking</a></li>
                <li><a href="#">reservations@hotelriver.com</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-4  col-sm-5">
          <div class="single-footer-caption mb-30">
            <div class="footer-tittle">
              <h4>Our Location</h4>
              <ul>
                <li><a href="#">Dhaka </a></li>
                <li><a href="#">Bangladesh</a></li>
              </ul>
              <!-- Form -->
              <div class="footer-form">
                <div id="mc_embed_signup">
                  <form target="_blank"
                        action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
                        class="subscribe_form relative mail_part">
                    <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address"
                           class="placeholder hide-on-focus" onfocus="this.placeholder = ''"
                           onblur="this.placeholder = ' Email Address '">
                    <div class="form-icon">
                      <button type="submit" name="submit" id="newsletter-submit"
                              class="email_icon newsletter-submit button-contactForm"><img
                          src="assets/img/logo/form-iocn.jpg" alt=""></button>
                    </div>
                    <div class="mt-10 info"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer End-->
</footer>
<!-- JS here -->
<!-- All JS Custom Plugins Link Here here -->
<script src="{{ asset('assets/frontend/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="{{ asset('assets/frontend/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/frontend/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/frontend/assets/js/bootstrap.min.js') }}"></script>
<!-- Jquery Mobile Menu -->
<script src="{{ asset('assets/frontend/assets/js/jquery.slicknav.min.js') }}"></script>
<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="{{ asset('assets/frontend/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/frontend/assets/js/slick.min.js') }}"></script>
<!-- Date Picker -->
<script src="{{ asset('assets/frontend/assets/js/gijgo.min.js') }}"></script>
<!-- One Page, Animated-HeadLin -->
<script src="{{ asset('assets/frontend/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/frontend/assets/js/animated.headline.js') }}"></script>
<script src="{{ asset('assets/frontend/assets/js/jquery.magnific-popup.js') }}"></script>
<!-- Scrollup, nice-select, sticky -->
<script src="{{ asset('assets/frontend/assets/js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('assets/frontend/assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/frontend/assets/js/jquery.sticky.js') }}"></script>
<!-- contact js -->
<script src="{{ asset('assets/frontend/assets/js/contact.js') }}"></script>
<script src="{{ asset('assets/frontend/assets/js/jquery.form.js') }}"></script>
<script src="{{ asset('assets/frontend/assets/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/frontend/assets/js/mail-script.js') }}"></script>
<script src="{{ asset('assets/frontend/assets/js/jquery.ajaxchimp.min.js') }}"></script>
<!-- Jquery Plugins, main Jquery -->
<script src="{{ asset('assets/frontend/assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/frontend/assets/js/main.js') }}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>window.dataLayer = window.dataLayer || [];

  function gtag() {
    dataLayer.push(arguments);
  }

  gtag('js', new Date());
  gtag('config', 'UA-23581568-13');</script>
@include('sweetalert::alert')
<script>
  $(document).ready(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  })
</script>
@yield('script')
</body>
</html>