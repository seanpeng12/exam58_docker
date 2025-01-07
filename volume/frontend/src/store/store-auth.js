import { LocalStorage } from "quasar";
import axios, { axiosInstance } from "boot/axios";
import { firebaseAuth, google_provider } from "boot/firebase";
import { showErrorMessage } from "src/functions/function-show-error-message";
const state = {
  loggedIn: false,
  role: "",
  userDetail: {},
  lineData: {
    client_id: 1654565142,
    // redirect_uri: "http://sightseeing.nctu.me/api/line_3",
    redirect_uri: "http://sightseeing.nctu.me:8080",
    // redirect_uri = "http://sightseeing.nctu.me/api/lineLogin",
  }
};
const mutations = {
  update_role(state, value) {
    state.role = value;
  },
  setLoggedIn(state, value) {
    state.loggedIn = value;
  },
  getUserDetail(state, value) {
    state.userDetail = value;
    console.log("state.userDetail1", state.userDetail);
  }
};
const actions = {
  registerUser({ }, payload) {
    firebaseAuth
      .createUserWithEmailAndPassword(payload.email, payload.password)
      .then(response => {
        if (state.role == "generalUser") {
          this.$router.push("/index").then(() => {
            this.$router.go(0);
          });
        } else if (state.role == "manager") {
          this.$router.push("/manager_index").then(() => {
            this.$router.go(0);
          });
        }
      })
      .catch(error => {
        showErrorMessage(error.message);
      });
  },
  loginUser({ }, payload) {
    firebaseAuth
      .signInWithEmailAndPassword(payload.email, payload.password)
      .then(response => {
        if (state.role == "generalUser") {
          this.$router.push("/index").then(() => {
            this.$router.go(0);
          });
        } else if (state.role == "manager") {
          this.$router.push("/manager_index").then(() => {
            this.$router.go(0);
          });
        }
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
        if (state.role == "generalUser") {
          this.$router.push("/index").then(() => {
            this.$router.go(0);
          });
        } else if (state.role == "manager") {
          this.$router.push("/manager_index").then(() => {
            this.$router.go(0);
          });
        }
      })
      .catch(err => console.error(err));
  },
  // line login
  loginWithLine() {
    console.log("LineAuth");
    let URL = "https://access.line.me/oauth2/v2.1/authorize?";
    // 必填
    URL += "response_type=code"; // 希望LINE回應什麼 但是目前只有code能選
    URL += `&client_id=${state.lineData.client_id}`; // 你的頻道ID
    URL += `&redirect_uri=${state.lineData.redirect_uri}`; // 要接收回傳訊息的網址
    URL += "&state=12345abcde"; // 用來防止跨站請求的 之後回傳會傳回來給你驗證 通常設亂數 這邊就先放123456789
    URL += "&scope=openid%20profile%20email"; // 跟使用者要求的權限 可從openid profile email 中選
    // 選填
    URL += "&ui_locales=zh-TW";
    window.open(URL, "_self"); // 轉跳到該網址
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
        // console.log("name : ", name);
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
        dispatch("collections/company_fbReadData", null, {
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
  getLineUserDetail({ commit }, code) {

    axiosInstance
      .post("http://140.136.155.116/api/line_3", {
        code: code
      })
      .then(res => {
        console.log("actions_code:", code);

        console.log("line_3 response資料:", res.data);
        console.log("then_res.data.name", res.data.name);

        // alert(res.data.name);
        commit("getUserDetail", res.data.name);
        firebaseAuth.signInWithCustomToken(res.data.response).catch(error => {
          showErrorMessage(error.message);
        });
        // this.$router.push("/index");

        // }).then(() => {
        // this.$router.push("/index");
      })
      .catch(err => {
        console.log("lineAuthError", err);
      });
  },
  chooseRole({ commit }, roleName) {
    // console.log("chooseRole:", roleName);
    localStorage.setItem("role", roleName);

    commit("update_role", roleName);
  },
  readRole({ commit }) {
    // console.log("reaadRole:", localStorage.getItem("role"));
    commit("update_role", localStorage.getItem("role"));
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
  },
  role: state => {
    return state.role;
  }
};
export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
};
