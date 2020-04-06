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
                        <li><a href="{{ route('ccc') }}">我的收藏景點</a></li>
                        <li><a href="{{ route('create_schedule') }}">自我旅程規劃</a></li>

                    </ul>
                </li>

                <li><a id="hola"></a></li>


                {{-- <li class="probootstra-cta-button" id="test" ><a href="" class="btn" data-toggle="modal"
                            data-target="#loginModal">Log in</a></li> --}}
                <li id="btnLogIn" class="probootstra-cta-button"><a href="#" class="btn" data-toggle="modal"
                        data-target="#signupModal">以google方式登入</a></li>

                <li id="btnLogOut" class="probootstra-cta-button last"><a href="#" class="btn btn-ghost"
                        data-toggle="modal" data-target="#signupModal">LogOut</a></li>
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
<<<<<<< HEAD
                                        /*<button class="btn btn-primary btn-ghost btn-block btn-connect-facebook"><span>connect
                                                with</span> Facebook</button>
                                        //下面是google存mysql的登入方式
                                         <a href="{{url('/redirect')}}" class="btn btn-primary">Login with
                                        Google</a> 
                                        <button class="btn btn-primary btn-ghost btn-block btn-connect-facebook" id="btnlogIn"> Google(firebase)</button>

                                         <button id="btnLogIn" class="btn btn-primary btn-ghost btn-block btn-connect-google">connect with Google</button>*/
=======
                                        {{-- <button class="btn btn-primary btn-ghost btn-block btn-connect-facebook"><span>connect
                                                with</span> Facebook</button> --}}
                                        {{-- 下面是google存mysql的登入方式 --}}
                                        {{-- <a href="{{url('/redirect')}}" class="btn btn-primary">Login with
                                        Google</a> --}}
                                        {{-- <button class="btn btn-primary btn-ghost btn-block btn-connect-facebook" id="btnlogIn"> Google(firebase)</button> --}}

                                        {{-- <button id="btnLogIn" class="btn btn-primary btn-ghost btn-block btn-connect-google">connect with Google</button> --}}
>>>>>>> ce59034887a1c63fba6bd605e617633555d6bb4d
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


<script>
<<<<<<< HEAD
    // Initialize Firebase


    /*var a = firebase.initializeApp(firebaseConfig);
    a.firestore().settings({
        timestampsInSnapshots: true
    })*/
    // ========登入帳號===========
    

    window.onload = function () {
        

        var btnLogIn = document.getElementById('btnLogIn');
        btnLogIn.onclick = function () {
            var provider = new firebase.auth.GoogleAuthProvider()
            // firebase.auth().signInWithRedirect(provider);
            //  firebase.auth().signInWithPopup(provider).
            firebase.auth().signInWithPopup(provider).then(function (result) {
                if (result.credential) {
                    // This gives you a Google Access Token. You can use it to access the Google API.

                    var token = result.credential.accessToken;
                    // ...
                    var user = result.user;

                    if (result.additionalUserInfo.isNewUser) {
                        window.location = '/fill_member_data';

                    } else {
                        console.log("not first");
                        // window.location = '/';
                        history.go(0);

                    }
=======
    // Initialize Firebase(possess0610)
    var firebaseConfig = {
            apiKey: "AIzaSyBC62oZBm9ftF_O0-eO7BPWx52vprEz38Y",
            authDomain: "sna-master.firebaseapp.com",
            databaseURL: "https://sna-master.firebaseio.com",
            projectId: "sna-master",
            storageBucket: "sna-master.appspot.com",
            messagingSenderId: "640892044634",
            appId: "1:640892044634:web:3c3c94c360528786d31f63",
            measurementId: "G-D1PL8FR9EF"
        };



  var a = firebase.initializeApp(firebaseConfig);
a.firestore().settings( { timestampsInSnapshots: true })
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
                    // window.location = '/';
                        history.go(0);

            }
>>>>>>> ce59034887a1c63fba6bd605e617633555d6bb4d



                }
                // The signed-in user info.


            }).catch(function (error) {
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
<<<<<<< HEAD

    }

    // ======== 登出帳號===========
    //var user = firebase.auth().currentUser;
=======
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
>>>>>>> ce59034887a1c63fba6bd605e617633555d6bb4d
    var btnLogOut = document.getElementById('btnLogOut');
    btnLogOut.onclick = function () {
        firebase.auth().signOut().then(function () {
            

            console.log(user);
            history.go(0);
            alert('您已登出帳號');
        })
    }

</script>
<script>
<<<<<<< HEAD
    firebase.auth().onAuthStateChanged(function (user) {
        var el = document.getElementById('btnLogIn');
        var el2 = document.getElementById('hola');

        if (user) {

            el.innerHTML = "";
            el2.innerHTML = user.displayName + "您好";
            // var displayName = user.displayName;
            console.log(user.displayName);
            // var email = user.email;
            console.log(user.uid);

        } else if (null) {

            // el.textContent=user.displayName+'歡迎您加入';
        }
    });

    
=======
    firebase.auth().onAuthStateChanged(function(user) {
                    var el=document.getElementById('btnLogIn');
                    var el2=document.getElementById('hola');

                    if (user) {

                        el.innerHTML="";
                        el2.innerHTML=user.displayName+"您好";
                        // var displayName = user.displayName;
                        console.log(user.displayName);
                        // var email = user.email;
                        console.log(user.email);
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




>>>>>>> ce59034887a1c63fba6bd605e617633555d6bb4d
</script>
