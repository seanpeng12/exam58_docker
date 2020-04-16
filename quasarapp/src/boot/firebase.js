import * as firebase from "firebase/app";
import "firebase/firestore";
// Add the Firebase products that you want to use

import "firebase/auth";

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
let firebaseApp = firebase.initializeApp(firebaseConfig);
let firebaseAuth = firebaseApp.auth();
let google_provider = new firebase.auth.GoogleAuthProvider();
let fstore = firebaseApp.firestore();
export {
  firebaseAuth,
  google_provider,
  fstore
};
