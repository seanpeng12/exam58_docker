<template>
  <div class="q-pa-md">
    <div class="row q-gutter-md q-mb-md">
      <q-btn color="primary" @click="login" />
    </div>
  </div>
</template>
<script>
import { firebaseAuth } from "boot/firebase";
import firebase from "firebase/app";
const fAuth = firebaseAuth.firestore();

export default {
  data() {
    return {
      user: {},
      isAuth: false
    };
  },
  created() {
    fAuth.onAuthStateChanged(user => {
      if (user) {
        this.user = user;
        this.isAuth = true;
      } else {
        this.user = {};
        this.isAuth = false;
      }
    });
  },
  methods: {
    login() {
      const authProvider = new firebase.auth.GoogleAuthProvider();
      fAuth
        .signInWithPopup(authProvider)
        .then(result => {
          this.user = result.user;
          this.isAuth = true;
        })
        .catch(err => console.error(err));
    },
    logout() {
      fAuth
        .signOut()
        .then(() => {
          this.user = {};
          this.isAuth = false;
        })
        .catch(err => console.log(err));
    }
  }
};
</script>
