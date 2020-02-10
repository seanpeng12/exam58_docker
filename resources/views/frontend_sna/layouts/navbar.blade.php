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
                        <li class="active"><a href='#'>我的旅程表</a></li>
                        <li><a href="portfolio.html">我的收藏景點</a></li>
                        <li><a href="{{ route('create_schedule') }}">自我旅程規劃</a></li>

                    </ul>
                </li>

                <li><a href="contact.html">Contact</a></li>

                
                <li class="probootstra-cta-button" id="test" ><a href="#" class="btn" data-toggle="modal"
                            data-target="#loginModal">Log in</a></li>
                <li id="btnLogOut" class="probootstra-cta-button last"><a href="#" class="btn btn-ghost" data-toggle="modal"
                        data-target="#signupModal">LogOut</a></li>
                {{-- <li class="probootstra-cta-button last"><button id="btnLogOut">LogOut</button></li> --}}
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
                                        {{-- 下面是google存mysql的登入方式 --}}
                                        {{-- <a href="{{url('/redirect')}}" class="btn btn-primary">Login with Google</a> --}}
                                        {{-- <button class="btn btn-primary btn-ghost btn-block btn-connect-facebook" id="btnlogIn"> Google(firebase)</button> --}}
    
                                        <button id="btnLogIn">LogIn</button>
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

{{-- firebase帳號登入登出 --}}

<script>

   
  
  // Initialize Firebase

  
  var a = firebase.initializeApp(firebaseConfig);
  console.log(a)

  // ========登入帳號===========

   window.onload = function() {
      var btnLogIn = document.getElementById('btnLogIn');
      btnLogIn.onclick = function() {
        var provider = new firebase.auth.GoogleAuthProvider()
        // firebase.auth().signInWithRedirect(provider);
        //  firebase.auth().signInWithPopup(provider).
        firebase.auth().signInWithPopup(provider).then(function(result) {
        if (result.credential) {
            // This gives you a Google Access Token. You can use it to access the Google API.
             
            var token = result.credential.accessToken;
            // ...
            var user = result.user;

            if(result.additionalUserInfo.isNewUser){
                    window.location = '/fill_member_data';
  
            }
            
            else{
                console.log("not first");
                    window.location = '/';
            }
           


        }
  // The signed-in user info.
 

        }).catch(function(error) {
            // Handle Errors here.
            var errorCode = error.code;
            var errorMessage = error.message;
            // The email of the user's account used.
            var email = error.email;
            // The firebase.auth.AuthCredential type that was used.
            var credential = error.credential;
            // ...
        });

        }    

    }
  
// ======== 登出帳號===========
    var btnLogOut = document.getElementById('btnLogOut');
btnLogOut.onclick = function() {
  firebase.auth().signOut().then(function() {
    var user = firebase.auth().currentUser;
    console.log(user);
    history.go(0);
    alert('您已登出帳號');
  })
}

</script>
<script>

      firebase.auth().onAuthStateChanged(function(user) {
                    var el=document.getElementById('test');
                 
                    if (user) {
                        
                        el.textContent="<br>"+user.displayName+'您好';

                        // var displayName = user.displayName;
                        // console.log(displayName);
                        // var email = user.email;
                        // console.log(email);
                        // var emailVerified = user.emailVerified;
                        // console.log(emailVerified);

                        // var photoURL = user.photoURL;
                        // var isAnonymous = user.isAnonymous;
                        // var uid = user.uid;
                        // console.log(uid);
                        // var providerData = user.providerData;
                        // console.log(providerData);

                        

                    } else if(null) {
                        
                        // el.textContent=user.displayName+'歡迎您加入';
                    }
                    });   

        

  
</script>