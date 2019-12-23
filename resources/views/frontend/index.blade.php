<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>uiCookies:Stack &mdash; Free Bootstrap Theme, Free Website Template</title>
    <meta name="description" content="Free Bootstrap Theme by uicookies.com">
    <meta name="keywords" content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,700">
    <link rel="stylesheet" href="css/ano/styles-merged.css">
    <link rel="stylesheet" href="css/ano/style.min.css">

    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.min.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <!-- Fixed navbar -->
    
    
    <nav class="navbar navbar-default navbar-fixed-top probootstrap-navbar">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html" title="uiCookies:Stack">Sightseeing</a>
        </div>

        <div id="navbar-collapse" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="index.html">Home</a></li>
            <li class="dropdown">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle">功能</a>
              <ul class="dropdown-menu">
                <li class="active"><a href="about.html">景點需求分析</a></li>
                <li><a href="portfolio.html">鄰近景點路徑規劃</a></li>
                <li><a href="portfolio-single.html">景點優缺點分析</a></li>
                <li class="dropdown-submenu dropdown">
                  <a href="#" data-toggle="dropdown" class="dropdown-toggle"><span>Sub Menu</span></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Second Level Menu</a></li>
                    <li><a href="#">Second Level Menu</a></li>
                    <li><a href="#">Second Level Menu</a></li>
                    <li><a href="#">Second Level Menu</a></li>
                  </ul>
                </li>
                <li><a href="services.html">Services</a></li>
              </ul>
            </li>

            <li class="dropdown">
              <a href="#" data-toggle="dropdown" class="dropdown-toggle">個人頁面</a>
              <ul class="dropdown-menu">
                <li class="active"><a href="about.html">我的旅程表</a></li>
                <li><a href="portfolio.html">我的收藏景點</a></li>
                <li><a href="{{ route('create_schedule') }}">自我旅程規劃</a></li>

              </ul>
            </li>

            <li><a href="contact.html">Contact</a></li>
            <li class="probootstra-cta-button"><a href="#" class="btn" data-toggle="modal" data-target="#loginModal">Log in</a></li>
            <li class="probootstra-cta-button last"><a href="#" class="btn btn-ghost" data-toggle="modal" data-target="#signupModal">Sign up</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <section class="flexslider">
      <ul class="slides">
        
        <li style="background-image: url(images/slider_2.jpg)" class="overlay">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <div class="probootstrap-slider-text text-center">
                  <h1 class="probootstrap-heading">About Us</h1>
                  <p class="probootstrap-subheading">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
    </section>


    <section class="probootstrap-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
            <h2>Team</h2>
          </div>
        </div>
        <!-- END row -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
            <a href="#" class="probootstrap-team">
              <img src="images/person_1.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive img-rounded">
              <div class="probootstrap-team-info">
                <h3>Jeremy Slater <span class="position">Co-Founder / Tech</span></h3>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
            <a href="#" class="probootstrap-team">
              <img src="images/person_2.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive img-rounded">
              <div class="probootstrap-team-info">
                <h3>James Butterly <span class="position">Co-Founder / Creative</span></h3>
              </div>
            </a>
          </div>
          
          <div class="clearfix visible-sm-block visible-xs-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
            <a href="#" class="probootstrap-team">
              <img src="images/person_3.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive img-rounded">
              <div class="probootstrap-team-info">
                <h3>Matthew Smith <span class="position">Developer</span></h3>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
            <a href="#" class="probootstrap-team">
              <img src="images/person_4.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive img-rounded">
              <div class="probootstrap-team-info">
                <h3>Ivan Dubovtsev <span class="position">Designer</span></h3>
                
              </div>
            </a>
          </div>

          <div class="clearfix visible-sm-block visible-xs-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
            <a href="#" class="probootstrap-team">
              <img src="images/person_2.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive img-rounded">
              <div class="probootstrap-team-info">
                <h3>James Butterly <span class="position">Co-Founder / Creative</span></h3>
              </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
            <a href="#" class="probootstrap-team">
              <img src="images/person_1.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive img-rounded">
              <div class="probootstrap-team-info">
                <h3>Jeremy Slater <span class="position">Co-Founder / Tech</span></h3>
              </div>
            </a>
          </div>
          
          <div class="clearfix visible-sm-block visible-xs-block"></div>

          <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
            <a href="#" class="probootstrap-team">
              <img src="images/person_4.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive img-rounded">
              <div class="probootstrap-team-info">
                <h3>Ivan Dubovtsev <span class="position">Designer</span></h3>
                
              </div>
            </a>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
            <a href="#" class="probootstrap-team">
              <img src="images/person_3.jpg" alt="Free Bootstrap Template by uicookies.com" class="img-responsive img-rounded">
              <div class="probootstrap-team-info">
                <h3>Matthew Smith <span class="position">Developer</span></h3>
              </div>
            </a>
          </div>
          

        </div>
      </div>
    </section>
  

    <section class="probootstrap-section proboostrap-clients probootstrap-bg-white probootstrap-zindex-above-showcase">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
            <h2>Big Company Trusts Us</h2>
            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
          </div>
        </div>
        <!-- END row -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-6 text-center client-logo probootstrap-animate" data-animate-effect="fadeIn">
            <img src="images/client_1.png" class="img-responsive" alt="Free Bootstrap Template by uicookies.com">
          </div>
          <div class="col-md-3 col-sm-6 col-xs-6 text-center client-logo probootstrap-animate" data-animate-effect="fadeIn">
            <img src="images/client_2.png" class="img-responsive" alt="Free Bootstrap Template by uicookies.com">
          </div>
          <div class="clearfix visible-sm-block visible-xs-block"></div>
          <div class="col-md-3 col-sm-6 col-xs-6 text-center client-logo probootstrap-animate" data-animate-effect="fadeIn">
            <img src="images/client_3.png" class="img-responsive" alt="Free Bootstrap Template by uicookies.com">
          </div>
          <div class="col-md-3 col-sm-6 col-xs-6 text-center client-logo probootstrap-animate" data-animate-effect="fadeIn">
            <img src="images/client_4.png" class="img-responsive" alt="Free Bootstrap Template by uicookies.com">
          </div>          
          
        </div>
      </div>
    </section>

    <section class="probootstrap-section probootstrap-bg-white probootstrap-border-top">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
            <h2>Our Products</h2>
            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
          </div>
        </div>
        <!-- END row -->
        <div class="row">
          <div class="col-md-12 probootstrap-animate"  data-animate-effect="fadeIn">

            <div class="owl-carousel owl-carousel-fullwidth border-rounded">
              <div class="item">
                <img src="images/img_showcase_1.jpg" alt="Free HTML5 Bootstrap Template by GetTemplates.co">
              </div>
              <div class="item">
                <img src="images/img_showcase_2.jpg" alt="Free HTML5 Bootstrap Template by GetTemplates.co">
              </div>
              <div class="item">
                <img src="images/img_showcase_1.jpg" alt="Free HTML5 Bootstrap Template by GetTemplates.co">
              </div>
              <div class="item">
                <img src="images/img_showcase_2.jpg" alt="Free HTML5 Bootstrap Template by GetTemplates.co">
              </div>
            </div>

          </div>

          
        </div>
        <!-- END row -->
      </div>
    </section>

    <section class="probootstrap-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="service left-icon probootstrap-animate" data-animate-effect="fadeInLeft">
              <div class="icon"><i class="icon-mobile3"></i></div>
              <div class="text">
                <h3>Responsive Design</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit iusto provident.</p>
              </div>  
            </div>
            <div class="service left-icon probootstrap-animate" data-animate-effect="fadeInLeft">
              <div class="icon"><i class="icon-presentation"></i></div>
              <div class="text">
                <h3>Business Solutions</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit iusto provident.</p>
              </div>
            </div>
            <div class="service left-icon probootstrap-animate" data-animate-effect="fadeInLeft">
              <div class="icon"><i class="icon-circle-compass"></i></div>
              <div class="text">
                <h3>Brand Identity</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit iusto provident.</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="service left-icon probootstrap-animate" data-animate-effect="fadeInLeft">
              <div class="icon"><i class="icon-lightbulb"></i></div>
              <div class="text">
                <h3>Creative Ideas</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
              </div>  
            </div>
            
            <div class="service left-icon probootstrap-animate" data-animate-effect="fadeInLeft">
              <div class="icon"><i class="icon-magnifying-glass2"></i></div>
              <div class="text">
                <h3>Search Engine Friendly</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
              </div>
            </div>
            
            <div class="service left-icon probootstrap-animate" data-animate-effect="fadeInLeft">
              <div class="icon"><i class="icon-browser2"></i></div>
              <div class="text">
                <h3>Easy Customization</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
              </div>
            </div>

          </div>
        </div>
        <!-- END row -->
      </div>
    </section>

    <section class="probootstrap-section probootstrap-border-top probootstrap-bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
            <h2>Testimonial</h2>
          </div>
        </div>
        <!-- END row -->
        <div class="row">
          <div class="col-md-12">
            <div class="owl-carousel owl-carousel-fullwidth">
              <div class="item">

                <div class="probootstrap-testimony-wrap text-center">
                  <figure>
                    <img src="images/person_1.jpg" alt="Free Bootstrap Template by uicookies.com">
                  </figure>
                  <blockquote class="quote">&ldquo;Design must be functional and functionality must be translated into visual aesthetics, without any reliance on gimmicks that have to be explained.&rdquo; <cite class="author">&mdash; Ferdinand A. Porsche <br> <span>Design Lead at AirBNB</span></cite></blockquote>
                </div>

              </div>
              <div class="item">
                <div class="probootstrap-testimony-wrap text-center">
                  <figure>
                    <img src="images/person_2.jpg" alt="Free Bootstrap Template by uicookies.com">
                  </figure>
                  <blockquote class="quote">&ldquo;Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn’t really do it, they just saw something. It seemed obvious to them after a while.&rdquo; <cite class="author">&mdash; Steve Jobs <br> <span>Co-Founder Square</span></cite></blockquote>
                </div>
              </div>
              <div class="item">
                <div class="probootstrap-testimony-wrap text-center">
                  <figure>
                    <img src="images/person_3.jpg" alt="Free Bootstrap Template by uicookies.com">
                  </figure>
                  <blockquote class="quote">&ldquo;I think design would be better if designers were much more skeptical about its applications. If you believe in the potency of your craft, where you choose to dole it out is not something to take lightly.&rdquo; <cite class="author">&mdash; Frank Chimero <br> <span>Creative Director at Twitter</span></cite></blockquote>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        <!-- END row -->
      </div>
    </section>
    
    <footer class="probootstrap-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="probootstrap-footer-widget">
              <h3>Paragraph</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus quos quibusdam soluta at.</p>
              <ul class="probootstrap-footer-social">
                <li><a href="#"><i class="icon-twitter"></i></a></li>
                <li><a href="#"><i class="icon-facebook"></i></a></li>
                <li><a href="#"><i class="icon-github"></i></a></li>
                <li><a href="#"><i class="icon-dribbble"></i></a></li>
                <li><a href="#"><i class="icon-linkedin"></i></a></li>
                <li><a href="#"><i class="icon-youtube"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-4">
                <div class="probootstrap-footer-widget">
                  <h3>Links</h3>
                  <ul>
                    <li><a href="#">Knowledge Base</a></li>
                    <li><a href="#">Career</a></li>
                    <li><a href="#">Press Releases</a></li>
                    <li><a href="#">Terms of services</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4">
                <div class="probootstrap-footer-widget">
                  <h3>Links</h3>
                  <ul>
                    <li><a href="#">Knowledge Base</a></li>
                    <li><a href="#">Career</a></li>
                    <li><a href="#">Press Releases</a></li>
                    <li><a href="#">Terms of services</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4">
                <div class="probootstrap-footer-widget">
                  <h3>Links</h3>
                  <ul>
                    <li><a href="#">Knowledge Base</a></li>
                    <li><a href="#">Career</a></li>
                    <li><a href="#">Press Releases</a></li>
                    <li><a href="#">Terms of services</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          
          
        </div>
        <!-- END row -->
        <div class="row">
          <div class="col-md-12 copyright">
            <p><small>&copy; 2017 <a href="https://uicookies.com/">uiCookies:Stack</a>. All Rights Reserved. <br> Designed &amp; Developed with <i class="icon icon-heart"></i> by <a href="https://uicookies.com/">uicookies.com</a></small></p>
          </div>
        </div>
      </div>
    </footer>
    

    <!-- Modal login -->
    <div class="modal fadeInUp probootstrap-animated" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-md vertical-align-center">
          <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-cross"></i></button>
            <div class="probootstrap-modal-flex">
              <div class="probootstrap-modal-figure" style="background-image: url(images/modal_bg.jpg);"></div>
              <div class="probootstrap-modal-content">
                <form action="#" class="probootstrap-form">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Email">
                  </div> 
                  <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password">
                  </div> 
                  <div class="form-group clearfix mb40">
                    <label for="remember" class="probootstrap-remember"><input type="checkbox" id="remember"> Remember Me</label>
                    <a href="#" class="probootstrap-forgot">Forgot Password?</a>
                  </div>
                  <div class="form-group text-left">
                    <div class="row">
                      <div class="col-md-6">
                        <input type="submit" class="btn btn-primary btn-block" value="Sign In">
                      </div>
                    </div>
                  </div>
                  <div class="form-group probootstrap-or">
                    <span><em>or</em></span>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <button class="btn btn-primary btn-ghost btn-block btn-connect-facebook"><span>connect with</span> Facebook</button>
                        
                        <a href="{{url('/redirect')}}" class="btn btn-primary btn-ghost btn-block btn-connect-google"">Login with Google</a>

                      </div>
                      
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END modal login -->
    
    <!-- Modal signup -->
    <div class="modal fadeInUp probootstrap-animated" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
      <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-md vertical-align-center">
          <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-cross"></i></button>
            <div class="probootstrap-modal-flex">
              <div class="probootstrap-modal-figure" style="background-image: url(images/modal_bg.jpg);"></div>
              <div class="probootstrap-modal-content">
                <form action="#" class="probootstrap-form">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Email">
                  </div> 
                  <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password">
                  </div> 
                  <div class="form-group">
                    <input type="password" class="form-control" placeholder="Re-type Password">
                  </div> 
                  <div class="form-group clearfix mb40">
                    <label for="remember" class="probootstrap-remember"><input type="checkbox" id="remember"> Remember Me</label>
                    <a href="#" class="probootstrap-forgot">Forgot Password?</a>
                  </div>
                  <div class="form-group text-left">
                    <div class="row">
                      <div class="col-md-6">
                        <input type="submit" class="btn btn-primary btn-block" value="Sign Up">
                      </div>
                    </div>
                    
                  </div>
                  <div class="form-group probootstrap-or">
                    <span><em>or</em></span>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-12">
                        <button class="btn btn-primary btn-ghost btn-block btn-connect-facebook"><span>connect with</span> Facebook</button>
                        <button class="btn btn-primary btn-ghost btn-block btn-connect-google"><span>connect with</span> Google</button>
                        <button class="btn btn-primary btn-ghost btn-block btn-connect-twitter"><span>connect with</span> Twitter</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END modal signup -->

    <script src="js/ano/scripts.min.js"></script>
    <script src="js/ano/custom.min.js"></script>
  </body>
</html>