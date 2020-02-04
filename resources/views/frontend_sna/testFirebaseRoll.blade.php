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
var provider = new firebase.auth.GoogleAuthProvider()
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
    </script>
</body>

</html>