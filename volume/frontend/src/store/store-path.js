import axios, { axiosInstance } from "boot/axios";
import Vue from "vue";

const state = {
  namespaced: true,

  // 選單選擇資料
  selected_city: "",
  selected_site: "",

  // 第一層選擇的景點
  selected_site_2: "",
  // 第二層選擇的景點
  selected_site_3: "",

  // 選單城市資料(axios用)
  citys: [],

  // 選單景點資料(axios用)
  sites: [],

  //schedule呼叫用
  start_index_2 : 0,

  // loading插件用（start R）
  start_index: 0,
  // R執行完呼叫重新整理用
  run_index: 0,
  // R執行完呼叫懶人包用
  data_index: 0,

  // r 圖產生位置
  src_path: "../statics/path.html",

  // 路徑點懶人包
  pathData: [],
  pathData_2: [],
  // 路徑景點google資訊
  siteGoogleDetails: {}

  // loading插件用（start R）
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
    return (state.selected_site = value);
  },
  // Reset_Selected_Site(state) {
  //   state.selected_site = {};
  // },
  Update_Selected_Site_2(state, value) {
    return (state.selected_site_2 = value);
  },
  Update_Selected_Site_3(state, value) {
    return (state.selected_site_3 = value);
  },
  Update_Start_Index_2(state, value) {
    return (state.start_index_2 += value);
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
  Update_src_path(state, value) {
    return (state.src_path = value);
  },
  Update_PathData(state, value) {
    return (state.pathData = value);
  },
  Update_PathData_2(state, value) {
    return (state.pathData_2 = value);
  },
  getSiteGoogleDetail(state, payload) {
    Vue.set(state.siteGoogleDetails, payload.id, payload.detail);
    // console.log("state.SiteGoogleDetail:", state.siteGoogleDetails);
  },
  resetSiteGoogleDetail(state) {
    state.siteGoogleDetails = {};
  }
};
const actions = {
  // 取景點/飯店城市
  fetchCitys({ commit }) {
    axiosInstance
      .get("http://140.136.155.116/api/site_dataCity")
      .then(res => {
        commit("FETCH_Citys", res.data);
        // console.log("vuex-get 城市(site)");
      })
      .catch(err => {
        console.log(err);
      });
  },

  // 取景點/飯店
  fetchSites({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/path_sitesByCity", {
        city_name: state.selected_city
      })
      .then(res => {
        commit("FETCH_Sites", res.data);
        // console.log("vuex-post取-景點資料到sites");
      })
      .catch(err => {
        console.log(err);
      });
  },
  h_fetchSites({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/h_path_sitesByCity", {
        city_name: state.selected_city
      })
      .then(res => {
        commit("FETCH_Sites", res.data);
        // console.log("vuex-post取-飯店資料到sites");
      })
      .catch(err => {
        console.log(err);
      });
  },

  fetchPathR({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/runPath", {
        city: state.selected_city,
        site: state.selected_site
      })
      .then(res => {
        console.log("執行路徑分析完成，更新run_index");
        // 讓R執行數
        commit("Update_Run_Index", 1);
      })
      .catch(err => {
        console.log(err);
      });
  },
  //
  fetchPath({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/PathData", {
        name: state.selected_site
      })
      .then(res => {
        // console.log("取得第一層景點懶人包");
        // console.log("path_data:", res);

        commit("Update_PathData", res);
      })
      .catch(function(response) {
        console.log(response);
      });
  },
  //
  fetchPath_2({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/PathData", {
        name: state.selected_site_2
      })
      .then(res => {
        // console.log("取得第二層景點懶人包");
        commit("Update_PathData_2", res);
      })
      .catch(function(response) {
        console.log(response);
      });
  },
  getSiteGoogleDetail({ commit }, site_name) {
    commit("resetSiteGoogleDetail");
    axiosInstance
      .post("http://140.136.155.116/api/getGoogleImg", {
        name: site_name
      })
      .then(img => {
        axiosInstance
          .post("http://140.136.155.116/api/pathSiteGooglePlaceId", {
            name: site_name
          })

          .then(res => {
            // console.log("googleDetail:", res.data);
            commit("getSiteGoogleDetail", {
              id: res.data.place_id,
              detail: {
                site_name: site_name,
                phone_number: res.data.formatted_phone_number,
                address: res.data.formatted_address,
                rating: res.data.rating,
                img: img.data
              }
            });
            // console.log("res.data--getSiteGoogleDetail", res.data);
          });
      });
  },
  searchCity({ commit, dispatch }, site_name) {
    axiosInstance
      .post("http://140.136.155.116/api/getCity", {
        name: site_name
      })
      .then(city => {
        commit("Update_Selected_City", city.data[0].city_name);
        // console.log("city:", city.data[0].city_name);
      })
      .then(() => {
        // 取第一層懶人包
        dispatch("fetchPath");
      })
      .then(() => {
        // run path.R
        dispatch("fetchPathR");
      });
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
  selected_site: state => {
    return state.selected_site;
  },
  selected_site_2: state => {
    return state.selected_site_2;
  },
  selected_site_3: state => {
    return state.selected_site_3;
  },
  start_index_2: state => {
    return state.start_index_2;
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
  src_path: state => {
    return state.src_path;
  },
  pathData: state => {
    return state.pathData;
  },
  pathData_2: state => {
    return state.pathData_2;
  },
  siteGoogleDetails: state => {
    return state.siteGoogleDetails;
  }
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
};
