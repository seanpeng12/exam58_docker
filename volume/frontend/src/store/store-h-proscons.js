import axios, { axiosInstance } from "boot/axios";
import Vue from "vue";
import { fstore, firebaseAuth, firebaseApp, firestore } from "boot/firebase";

const state = {
  namespaced: true,

  // 選單選擇資料
  selected_city: "",
  selected_site: "",

  // 按下確定開始執行
  start_index: 0,
  // 選單城市資料(axios用)
  citys: [],
  // 選單景點資料(axios用)
  sites: [],

  // R執行完呼叫重新整理用
  run_index: 0,
  // R執行完呼叫懶人包用
  data_index: 0,

  // r 圖產生位置
  src_good: "../statics/h_good.html",
  src_bad: "../statics/h_bad.html",

  // 優缺點懶人包
  prosData: [],
  consData: [],
  // 景點是否在
  checkCollectionExists: {}
};
const mutations = {
  FETCH_Citys(state, value) {
    return (state.citys = value);
  },
  FETCH_Sites(state, value) {
    return (state.sites = value);
  },
  Update_Selected_City(state, value) {
    return (state.selected_city = value);
  },
  Update_Selected_Site(state, value) {
    console.log("hpros:", value);
    return (state.selected_site = value);
  },
  Update_Start_Index(state, value) {
    return (state.start_index += value);
  },
  Update_Run_Index(state, value) {
    return (state.run_index += value);
  },
  Update_Data_Index(state, value) {
    return (state.data_index += value);
  },
  Update_Good_Src(state, value) {
    return (state.src_good = value);
  },
  Update_Bad_Src(state, value) {
    return (state.src_bad = value);
  },
  Update_ProsData(state, value) {
    return (state.prosData = value);
  },
  Update_ConsData(state, value) {
    return (state.consData = value);
  },
  // 檢查飯店是否在收藏
  checkCollectionExists(state, value) {
    state.checkCollectionExists = value;
    console.log(
      "checkCollectionExists from mutation:",
      state.checkCollectionExists
    );
  }
};
const actions = {
  fetchCitys({ commit }) {
    axiosInstance
      .get("http://140.136.155.116/api/proscons_hotel_data_City")
      .then(res => {
        commit("FETCH_Citys", res.data);
        console.log("vuex-get 城市");
      })
      .catch(err => {
        console.log(err);
      });
  },

  fetchSites({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/h_sitesByCity", {
        city_name: state.selected_city
      })
      .then(res => {
        commit("FETCH_Sites", res.data);
        console.log("vuex-post api取景點資料");
      })
      .catch(err => {
        console.log(err);
      });
  },

  fetchProsConsR({ commit, dispatch }) {
    axiosInstance
      .post("http://140.136.155.116/api/h_proscons", {
        name: state.selected_site
      })
      .then(res => {
        console.log("執行優缺分析完成，產生h_good,h_bad.html ");
        // 讓R執行數
        commit("Update_Run_Index", 1);
      })
      .catch(err => {
        console.log(err);
      });
  },

  fetchPros({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/h_prosData", {
        name: state.selected_site
      })
      .then(res => {
        console.log("取得飯店優點");
        commit("Update_ProsData", res);
      })
      .catch(err => {
        console.log(err);
      });
  },

  fetchCons({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/h_consData", {
        name: state.selected_site
      })
      .then(res => {
        console.log("取得飯店缺點");
        commit("Update_ConsData", res);
      })
      .catch(err => {
        console.log(err);
      });
  },
  siteExistsCollection({ commit }, site_name) {
    const uid = firebaseAuth.currentUser.uid;
    const checkCollectionExists = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的飯店收藏");

    axiosInstance
      .post("http://140.136.155.116/api/h_proconsAddToCollection", {
        name: site_name
      })
      .then(datas => {
        console.log("取優缺id測試:", datas.data[0].id);

        checkCollectionExists
          .doc(datas.data[0].id)
          .get()
          .then(function(doc) {
            if (doc.exists) {
              console.log("存在");

              commit("checkCollectionExists", {
                exists: true
              });
            } else {
              console.log("不存在");

              commit("checkCollectionExists", {
                exists: false
              });
            }
          });
      });
    //
  }
};

const getters = {
  citys: state => {
    return state.citys;
  },
  sites: state => {
    return state.sites;
  },

  selected_city: state => {
    return state.selected_city;
  },
  h_prosConsselected_site: state => {
    return state.selected_site;
  },
  selected_city_local: state => {
    return state.selected_city_local;
  },
  start_index: state => {
    return state.start_index;
  },
  run_index: state => {
    return state.run_index;
  },
  data_index: state => {
    return state.data_index;
  },
  src_good: state => {
    return state.src_good;
  },
  src_bad: state => {
    return state.src_bad;
  },
  prosData: state => {
    return state.prosData;
  },
  consData: state => {
    return state.consData;
  },
  checkCollectionExist: state => {
    return state.checkCollectionExists;
  }
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
};
