{{-- <nav class="probootstrap-nav">
 
          <ul>
          
            <li class="probootstrap-animate active" data-animate-effect="fadeInLeft"><a href="{{ route('my_travel') }}">我的旅程表</a>
</li>
<li class="probootstrap-animate" data-animate-effect="fadeInLeft"><a href="{{ route('about') }}">About</a></li>
<li class="probootstrap-animate" data-animate-effect="fadeInLeft"><a href="{{ route('services') }}">Services</a></li>
<li class="probootstrap-animate" data-animate-effect="fadeInLeft"><a href="{{ route('portfolio') }}">Portfolio</a></li>
<li class="probootstrap-animate" data-animate-effect="fadeInLeft"><a href="{{ route('contact') }}">Contact</a></li>

</ul>

</nav> --}}
<nav class="navbar navbar-default navbar-fixed-top probootstrap-navbar">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"
                aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html" title="uiCookies:Stack">Sightseeing</a>
        </div>

        <div id="navbar-collapse" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">功能</a>
                    <ul class="dropdown-menu">
                        <li class="active"><a href="{{route('myform')}}">景點需求分析</a></li>
                        <li><a href=" portfolio.html">鄰近景點路徑規劃</a></li>
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
                <li class="probootstra-cta-button"><a href="#" class="btn" data-toggle="modal"
                        data-target="#loginModal">Log in</a></li>
                <li class="probootstra-cta-button last"><a href="#" class="btn btn-ghost" data-toggle="modal"
                        data-target="#signupModal">Sign up</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal login -->
<div class="modal fadeInUp probootstrap-animated" id="loginModal" tabindex="-1" role="dialog"
    aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog modal-md vertical-align-center">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i
                        class="icon-cross"></i></button>
                <div class="probootstrap-modal-flex">
                    <div class="probootstrap-modal-figure" style="background-image: url(img/modal_bg.jpg);"></div>
                    <div class="probootstrap-modal-content">
                        <form action="#" class="probootstrap-form">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group clearfix mb40">
                                <label for="remember" class="probootstrap-remember"><input type="checkbox"
                                        id="remember"> Remember Me</label>
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
                                        <button class="btn btn-primary btn-ghost btn-block btn-connect-facebook"><span>connect
                                                with</span> Facebook</button>
                                        {{-- <button class="btn btn-primary btn-ghost btn-block btn-connect-google"><span>connect
                                                with</span> Google</button>
                                        <button class="btn btn-primary btn-ghost btn-block btn-connect-twitter"><span>connect
                                                with</span> Twitter</button> --}}
                                        <a href="{{url('/redirect')}}" class="btn btn-primary">Login with Google</a>
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