<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tyy it</title>
</head>
<body>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.9.1/firebase-auth.js"></script>
<button id="btnLogIn" class="fb">使用facebook註冊(Popup)</button>
{{-- <button id="facebookSingUpRedirect" class="fb">使用facebook註冊(Redirect)</button> --}}

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
  // Initialize Firebase
  var a = firebase.initializeApp(firebaseConfig);
  console.log(a)
</script>
<script>
    var provider = new firebase.auth.FacebookAuthProvider()

    var btn = document.getElementById('btnLogIn');
btn.onclick = function() {
 firebase.auth().signInWithPopup(provider).then(function(result) {
  // This gives you a Facebook Access Token. You can use it to access the Facebook API.
  var token = result.credential.accessToken;
  // The signed-in user info.
  var user = result.user;
  // ...
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
  </script>

  <fb:login-button scope="public_profile,email" autologoutlink="true" onlogin="checkLoginState();"></fb:login-button>

目前狀態：<span id="FB_STATUS_1"></span>

<script>
window.fbAsyncInit = function() {
FB.init({
appId: '', // 填入 FB APP ID
cookie: true,
xfbml: true,
version: 'v3.2'
});
FB.getLoginStatus(function(response) {
statusChangeCallback(response);
});
};
// 處理各種登入身份
function statusChangeCallback(response) {
console.log(response);
var target = document.getElementById("FB_STATUS_1"),
html = "";
// 登入 FB 且已加入會員
if (response.status === 'connected') {
html = "已登入 FB，並加入 友廷等公車應用程式<br/>";
FB.api('/me?fields=id,name,email', function(response) {
console.log(response);
html += "會員暱稱：" + response.name + "<br/>";
html += "會員 email：" + response.email+ "<br/>";
html += "會員 uid :" + response.id;
target.innerHTML = html;
});
}
// 登入 FB, 未偵測到加入會員
else if (response.status === "not_authorized") {
target.innerHTML = "已登入 FB，但未加入 友廷等公車應用程式 應用程式";
}
// 未登入 FB
else {
target.innerHTML = "未登入 FB";
}
}
function checkLoginState() {
FB.getLoginStatus(function(response) {
statusChangeCallback(response);
});
}
// 載入 FB SDK
(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s);
js.id = id;
js.src = "https://connect.facebook.net/zh_TW/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

 
</body>

</html>