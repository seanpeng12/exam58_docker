@extends('frontend.layouts.master')
@section('title', 'about')
@section('content')



    <main role="main" class="probootstrap-main js-probootstrap-main">
      <div class="probootstrap-bar">
        <a href="#" class="probootstrap-toggle js-probootstrap-toggle"><span class="oi oi-menu"></span></a>
        <div class="probootstrap-main-site-logo"><a href="index.html">Aside</a></a></div>
      </div>
      <div class="container-fluid">
        <div class="row justify-content-center">
          {{-- googlemap --}}
          <div style="display: none">
        <input id="origin-input" class="controls" type="text"
            placeholder="Enter an origin location">

        <input id="destination-input" class="controls" type="text"
            placeholder="Enter a destination location">

        <div id="mode-selector" class="controls">
          <input type="radio" name="type" id="changemode-walking" checked="checked">
          <label for="changemode-walking">Walking</label>

          <input type="radio" name="type" id="changemode-transit">
          <label for="changemode-transit">Transit</label>

          <input type="radio" name="type" id="changemode-driving">
          <label for="changemode-driving">Driving</label>
        </div>
    </div>

    <div id="map"></div>
        </div>
        <!-- END row -->

        <section class="probootstrap-section">
          <div class="container-fluid">
            <div class="row mb-5 justify-content-center">
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-8 mx-auto">
                    <h2 class="h1 mb-5 mt-0">The Team</h2>    
                  </div>
                </div>
                
              </div>
            </div>
            <div class="row mb-5">
              <div class="col-md-12">
                <div class="owl-carousel probootstrap-owl">
                  <div class="item">
                    <img src="images/person_1.jpg" class="img-fluid" alt="Free Template by uicookies.com">
                    <div class="p-4 border border-top-0">
                      <h4>James Carl</h4>
                      <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/person_2.jpg" class="img-fluid" alt="Free Template by uicookies.com">
                    <div class="p-4 border border-top-0">
                      <h4>Craig Smith</h4>
                      <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/person_3.jpg" class="img-fluid" alt="Free Template by uicookies.com">
                    <div class="p-4 border border-top-0">
                      <h4>Peter Wood</h4>
                      <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/person_1.jpg" class="img-fluid" alt="Free Template by uicookies.com">
                    <div class="p-4 border border-top-0">
                      <h4>James Carl</h4>
                      <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                  </div>
                  <div class="item">
                    <img src="images/person_2.jpg" class="img-fluid" alt="Free Template by uicookies.com">
                    <div class="p-4 border border-top-0">
                      <h4>Craig Smith</h4>
                      <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            

            
          </div>
        </section>
        <!-- END section -->

      </div>

      <div class="container-fluid d-md-none">
        <div class="row">
          <div class="col-md-12">
            <ul class="list-unstyled d-flex probootstrap-aside-social">
              <li><a href="#" class="p-2"><span class="icon-twitter"></span></a></li>
              <li><a href="#" class="p-2"><span class="icon-instagram"></span></a></li>
              <li><a href="#" class="p-2"><span class="icon-dribbble"></span></a></li>
            </ul>
            <p>&copy; 2017 <a href="https://uicookies.com/" target="_blank">uiCookies:Aside</a>. <br> All Rights Reserved. Designed by <a href="https://uicookies.com/" target="_blank">uicookies.com</a></p>
          </div>
        </div>
      </div>

    </main>

    

    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>

    <script src="js/main.js"></script>
    
    @include('frontend.layouts.Place_Autocomplete_and_Directions')
  </body>
</html>