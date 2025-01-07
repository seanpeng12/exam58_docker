@extends('frontend_sna.layouts.master')

{{-- @section('title', 'services') --}}
@section('content')

<section class="flexslider">
    <ul class="slides">

        <li style="background-image: url(images/slider_2.jpg)" class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="probootstrap-slider-text text-center">
                            <h1 class="probootstrap-heading">旅遊分析系統</h1>
                            <p class="probootstrap-subheading">
                                <a href="http://sightseeing.im.fju.edu.tw:8080">點此進入首頁</a>
                            </p>
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
                <h2>Choose For purpose</h2>
            </div>
        </div>
        <!-- END row -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                {{-- delete --}}
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                <a href="#" class="probootstrap-team">
                    <img src="images/person_2.jpg" alt="Free Bootstrap Template by uicookies.com"
                        class="img-responsive img-rounded">
                    <div class="probootstrap-team-info">
                        <h3>分項功能 <span class="position">Co-Founder / Creative</span></h3>
                    </div>
                </a>
            </div>

            <div class="clearfix visible-sm-block visible-xs-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                {{-- delete --}}
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                {{-- delete --}}
            </div>

            <div class="clearfix visible-sm-block visible-xs-block"></div>

            <div id="itinerary" class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                {{--  <a href={{ route('my_itinerary') }} class="probootstrap-team"> --}}
                <div class="probootstrap-team cursor">

                    <img src="images/person_2.jpg" alt="Free Bootstrap Template by uicookies.com"
                        class="img-responsive img-rounded">
                    <div class="probootstrap-team-info">
                        <h3>規劃旅程 <span class="position">Co-Founder / Creative</span></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                {{-- delete --}}
            </div>

            <div class="clearfix visible-sm-block visible-xs-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                {{-- delete --}}
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 probootstrap-animate">
                {{-- delete --}}
            </div>


        </div>
    </div>
</section>


<section class="probootstrap-section proboostrap-clients probootstrap-bg-white probootstrap-zindex-above-showcase">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center section-heading probootstrap-animate">
                <h2>Big Company Trusts Us</h2>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore
                    natus quos
                    quibusdam soluta at.</p>
            </div>
        </div>
        <!-- END row -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-6 text-center client-logo probootstrap-animate"
                data-animate-effect="fadeIn">
                <img src="images/client_1.png" class="img-responsive" alt="Free Bootstrap Template by uicookies.com">
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 text-center client-logo probootstrap-animate"
                data-animate-effect="fadeIn">
                <img src="images/client_2.png" class="img-responsive" alt="Free Bootstrap Template by uicookies.com">
            </div>
            <div class="clearfix visible-sm-block visible-xs-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-6 text-center client-logo probootstrap-animate"
                data-animate-effect="fadeIn">
                <img src="images/client_3.png" class="img-responsive" alt="Free Bootstrap Template by uicookies.com">
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 text-center client-logo probootstrap-animate"
                data-animate-effect="fadeIn">
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
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore
                    natus quos
                    quibusdam soluta at.</p>
            </div>
        </div>
        <!-- END row -->
        <div class="row">
            <div class="col-md-12 probootstrap-animate" data-animate-effect="fadeIn">

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
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus
                            quos quibusdam
                            soluta at.</p>
                    </div>
                </div>

                <div class="service left-icon probootstrap-animate" data-animate-effect="fadeInLeft">
                    <div class="icon"><i class="icon-magnifying-glass2"></i></div>
                    <div class="text">
                        <h3>Search Engine Friendly</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus
                            quos quibusdam
                            soluta at.</p>
                    </div>
                </div>

                <div class="service left-icon probootstrap-animate" data-animate-effect="fadeInLeft">
                    <div class="icon"><i class="icon-browser2"></i></div>
                    <div class="text">
                        <h3>Easy Customization</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto provident qui tempore natus
                            quos quibusdam
                            soluta at.</p>
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
                            <blockquote class="quote">&ldquo;Design must be functional and functionality must be
                                translated into
                                visual aesthetics, without any reliance on gimmicks that have to be explained.&rdquo;
                                <cite class="author">&mdash; Ferdinand A. Porsche <br> <span>Design Lead at
                                        AirBNB</span></cite>
                            </blockquote>
                        </div>

                    </div>
                    <div class="item">
                        <div class="probootstrap-testimony-wrap text-center">
                            <figure>
                                <img src="images/person_2.jpg" alt="Free Bootstrap Template by uicookies.com">
                            </figure>
                            <blockquote class="quote">&ldquo;Creativity is just connecting things. When you ask creative
                                people how
                                they did something, they feel a little guilty because they didn’t really do it, they
                                just saw something.
                                It seemed obvious to them after a while.&rdquo; <cite class="author">&mdash; Steve Jobs
                                    <br>
                                    <span>Co-Founder Square</span></cite></blockquote>
                        </div>
                    </div>
                    <div class="item">
                        <div class="probootstrap-testimony-wrap text-center">
                            <figure>
                                <img src="images/person_3.jpg" alt="Free Bootstrap Template by uicookies.com">
                            </figure>
                            <blockquote class="quote">&ldquo;I think design would be better if designers were much more
                                skeptical
                                about its applications. If you believe in the potency of your craft, where you choose to
                                dole it out is
                                not something to take lightly.&rdquo; <cite class="author">&mdash; Frank Chimero <br>
                                    <span>Creative
                                        Director at Twitter</span></cite></blockquote>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{--   END row   --}}
    </div>
</section>
<script>
    var itinerary = document.getElementById('itinerary');
    itinerary.addEventListener('click', function () {
        var user = firebase.auth().currentUser;
        if (!user) {
            alert('請先登入帳號，才可使用使用本功能');
        } else {            
            window.location = 'my_itinerary';
        }
    });
</script>
