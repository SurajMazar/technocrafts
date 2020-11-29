<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      <meta charset="utf-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="api-base-url" content="{{ route('home') }}" />
      <meta name="description" content="Page description. No longer than 155 characters." /> 
      @yield('og')

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
      <!-- Scripts -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link href="{{ asset('css/loader.css') }}" rel="stylesheet">
    </head>
    <body>
     {{--  <div id="loader">
        <div class="infinity">
          <div>
            <span></span>
          </div>
          <div>
            <span></span>
          </div>
          <div>
            <span></span>
          </div>
        </div>
      </div> --}}
      <header>
        <div class="topbar">
          <div class="row">
            <div class="col-md-6">
              <div class="topbar__social">
                <a href="#" class="topbar__social__link"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="topbar__social__link"><i class="fab fa-instagram"></i></a>
                <a href="#" class="topbar__social__link"><i class="fab fa-youtube"></i></a>
                <a href="#" class="topbar__social__link"><i class="fab fa-google-plus-g"></i></a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="topbar__info">
                <a href="#" class="topbar__info__link"><i class="fas fa-map-marker-alt"></i>{{ config('app.email') }}</a>
                <a href="#" class="topbar__info__link"><i class="fa fa-phone"></i>+977-1234567890</a>
              </div>
            </div>
          </div>
        </div>

        <div class="header">
          <div class="row">
            <div class="col-md-2">
              <div class="logo">
                <a href="{{ route('home') }}"><img src="/images/technocrafts-logo.png" alt=""></a>
              </div>
            </div>
            <div class="col-md-10">
              <nav class="navigation" id='nav'>
                <div class="hamburger">
                  <div class="line"></div>
                  <div class="line"></div>
                  <div class="line"></div>
                </div>
                <ul class="navigation__menu">
                  <li class="navigation__menu__list">
                    <a href="{{ route('home') }}" class="navigation__menu__list__link">Home</a>
                  </li>
                  <li class="navigation__menu__list">
                    <a href="" class="navigation__menu__list__link">About</a>
                  </li>
                  <li class="navigation__menu__list">
                    <a href="{{ route('blogs') }}" class="navigation__menu__list__link">Blogs</a>
                  </li>
                  <li class="navigation__menu__list">
                    <a href="{{ route('laptop') }}" class="navigation__menu__list__link">Laptops</a>
                  </li>
                  <li class="navigation__menu__list">
                    <a href="{{ route('smartphone') }}" class="navigation__menu__list__link">Smart Phones</a>
                  </li>
                  <li class="navigation__menu__list">
                    <a href="{{ route('brands') }}" class="navigation__menu__list__link">Brands</a>
                  </li>
                  <li class="navigation__menu__list">
                    <a href="{{ route('compare_gadget') }}" class="navigation__menu__list__link">Compare gadgets</a>
                  </li>
                  <li class="navigation__menu__list">
                    <a href="{{ route('become_writer') }}" class="navigation__menu__list__link">Become a writer</a>
                  </li>
                  <li class="navigation__menu__list">
                    <a href="#" class="navigation__menu__list__link">Contact</a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        
      </header>
      <div id="app">
        @yield('content')

        
          <subscriber></subscriber>
        </div>

      <footer class='footer'>
        <div class="container">
          <div class="row">

            <div class="col-md-4">
              <div class="footer-image">
                <div class="footer-menu-title">
                  <h5>About TechnoCrafts<hr class="footer-hr"></h5>
                </div>
                <div class='footer-about'>
                  <p>TechnoCrafts’ is a virtual media for providing articles and information related to both hardware and software to the people in a systematic and factful way.</p><p>Its aim is to provide knowledge and make people concerned of the ongoing drastic changes in human civilizations.</p> 
                </div >
              </div>
            </div>

            <div class="col-md-4">
              <div class="footer-menu">
                <div class="footer-menu-title">
                  <h5>Quick Links<hr class="footer-hr"></h5>
                </div>
                <ul>
                  <li><a href="/home">Home</a></li>
                  <li><a href="">About us</a></li>
                  <li><a href=''>Blogs</a></li>
                  <li><a href="/all-laptops">Laptops</a></li>
                  <li><a href="">Smart Phones</a></li>
                  <li><a href='/compare-gadget'>Compare Gadgets</a></li>
                  <li><a href="">Become a writer!</a></li>
                  <li><a href="">Contact us</a></li>
                </ul>
              </div>
            </div>

            <div class="col-md-4">
           {{--    <div class="footer-menu-title">
                  <h5>Our Location<hr class="footer-hr"></h5>
                </div>
              <div class="footer-map">
                <iframe style='max-width:100%'src="https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d56504.52437703232!2d85.28262856876793!3d27.731708692005036!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d27.7647454!2d85.3446312!4m5!1s0x39eb1865a4ff2569%3A0x27b75b1ebc621451!2shenry%20ford%20college!3m2!1d27.694976399999998!2d85.2851503!5e0!3m2!1sen!2snp!4v1588820662169!5m2!1sen!2snp" width="300" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
              </div> --}}
              <div class="footer-social">
                <div class="footer-menu-title">
                  <h5>Find us on!!<hr class="footer-hr"></h5>
                </div>
                <ul>
                  <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                  <li><a href=""><i class="fab fa-instagram"></i></a></li>
                  <li><a href=""><i class="fab fa-youtube"></i></a></li>
                </ul>
                
              </div>
            </div>
          </div>
        </div>
      </footer>

      <div class="copyright-area clearfix">
        <div class="container">
          <div class="copyright-text">
          © 2020 TechnoCrafts . All rights reserved.
          <div class="cp2"> | Designed & Developed By <a href="" target="_blank"></a>  </div>     
          </div>
        </div>
      </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
      <script src="{{ asset('js/app.js') }}" defer></script>
      <script src="{{ asset('js/main.js') }}" defer></script>
      {{-- <script>
 window.addEventListener("load",
function(){
  let loader=document.getElementById('loader');
  loader.style.display='none';
 });
</script> --}}

    
    </body>
</html>
