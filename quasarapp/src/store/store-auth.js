import { LocalStorage } from "quasar";
import { firebaseAuth, google_provider } from "boot/firebase";
import { showErrorMessage } from "src/functions/function-show-error-message";
const state = {
  loggedIn: false,
  role: {},
  userDetail: {}
};
const mutations = {
  setLoggedIn(state, value) {
    state.loggedIn = value;
  },
  getUserDetail(state, value) {
    state.userDetail = value;
    console.log("state.userDetail", state.userDetail);
  }
};
const actions = {
  registerUser({}, payload) {
    firebaseAuth
      .createUserWithEmailAndPassword(payload.email, payload.password)
      .then(response => {
        console.log("response : ", response);
      })
      .catch(error => {
        showErrorMessage(error.message);
      });
  },
  loginUser({}, payload) {
    firebaseAuth
      .signInWithEmailAndPassword(payload.email, payload.password)
      .then(response => {
        this.$router.push("/").then(() => {
          this.$router.go(0);
        });
      })
      .catch(error => {
        showErrorMessage(error.message);
      });
  },
  loginWithGoogle() {
    firebaseAuth
      .signInWithPopup(google_provider)
      .then(result => {
        this.user = result.user;
        this.$router.push("/").then(() => {
          this.$router.go(0);
        });
      })
      .catch(err => console.error(err));
  },
  logoutUser() {
    firebaseAuth.signOut();
    console.log("logout");

    this.$router.push("/").then(() => {
      console.log("reload");

      this.$router.go(0);
    });
  },

  handleAuthStateChange({ commit, dispatch }, scheduleId) {
    firebaseAuth.onAuthStateChanged(user => {
      if (user) {
        const name = firebaseAuth.currentUser.displayName;
        commit("getUserDetail", name);
        console.log("name : ", name);
        commit("setLoggedIn", true);
        LocalStorage.set("loggedIn", true);
        // this.$router.push("/").catch((err) => {});
        // 每次載入頁面就會判斷登入者狀態，如果為true就會觸發store-firebase(index.js定義為travel)的fbReadData
        dispatch("travel/fbReadData", null, {
          root: true
        });

        dispatch("collections/fbReadData", null, {
          root: true
        });
        dispatch("collections/h_fbReadData", null, {
          root: true
        });
        dispatch("travel/fbEverySiteData", scheduleId, {
          root: true
        });
        console.log("登入成功");
      } else {
        commit("setLoggedIn", false);
        LocalStorage.set("loggedIn", false);
        // this.$router.replace("/Pageauth").catch((err) => {});
      }
    });
  },
  chooseRole({ commit }, roleName) {
    console.log("roleName from action", roleName);
    LocalStorage.set("role", roleName);
  }
};
const getters = {
  funcs: state => {
    return state.funcs;
  },
  userDetails: state => {
    return state.userDetail;
  },
  loggedIn: state => {
    return state.loggedIn;
  }
};
export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
};
