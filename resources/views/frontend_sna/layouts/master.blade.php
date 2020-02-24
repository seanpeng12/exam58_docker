{{-- <!DOCTYPE html>
<html lang="zh-TW">
  <head>
    <title>Aside - Free HTML5 Bootstrap 4 Template by uicookies.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Free HTML5 Website Template by uicookies.com" />
    <meta name="keywords" content="free bootstrap 4, free bootstrap 4 template, free website templates, free html5, free template, free website template, html5, css3, mobile first, responsive" />
    <meta name="author" content="uicookies.com" />

    @yield('title')




    <link href="https://fonts.googleapis.com/css?family=Work+Sans" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/style.css">





  </head> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>uiCookies:Stack &mdash; Free Bootstrap Theme, Free Website Template</title>
    <meta name="description" content="Free Bootstrap Theme by uicookies.com">
    <meta name="keywords"
        content="free website templates, free bootstrap themes, free template, free bootstrap, free website template">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,500,700">
    <link rel="stylesheet" href="css/ano/styles-merged.css">
    <link rel="stylesheet" href="css/ano/style.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

  <link href="//raw.githack.com/hnzzmsf/layui-formSelects/master/dist/formSelects-v4.css" rel="stylesheet" />
<script src="https://www.gstatic.com/firebasejs/6.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-firestore.js"></script>
  {{-- <script src="//unpkg.com/jquery@3.3.1/dist/jquery.min.js"></script>
  <script src="//raw.githack.com/hnzzmsf/layui-formSelects/master/dist/formSelects-v4.min.js"></script> --}}

<script>
// Your web app's Firebase configuration
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
</script>



    




</head>


{{-- <body onload="initialize()"> --}}

<body>
    {!! csrf_field() !!}
    {{-- @yield('firebase') --}}



  @include('frontend_sna.layouts.navbar')
  @yield('content')
  {{-- @include('frontend_sna.layouts.footer') --}}










    {{-- <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>

    <script src="js/main.js"></script>


  </body>
</html> --}}

  <script src="js/ano/scripts.min.js"></script>
  <script src="js/ano/custom.min.js"></script>

  
   

</body>

</html>
