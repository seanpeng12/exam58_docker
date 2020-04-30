import axios, {
  axiosInstance
} from 'boot/axios'
import Vue from 'vue'
import { fstore, firebaseAuth, firebaseApp, firestore } from "boot/firebase";

const state = {
  namespaced: true,

  // 選單選擇資料
  selected_city: "",
  selected_site: "",

  // 第一層選擇的景點
  selected_site_2:"",
  // 第二層選擇的景點
  selected_site_3:"",

  // 選單城市資料(axios用)
  citys: [],
  // 選單景點資料(axios用)
  sites: [],

  // R執行完呼叫重新整理用
  run_index: 0,
  // R執行完呼叫懶人包用
  data_index:0,

  // r 圖產生位置
  src_path: "./statics/path.html",


  // 路徑點懶人包
  pathData: [],
  pathData_2: []

}
const mutations = {

  FETCH_Citys(state, value) {
    return state.citys = value
  },
  FETCH_Sites(state, value) {
    return state.sites = value
  },
  Update_Selected_City(state, value) {
    return state.selected_city = value
  },
  Update_Selected_Site(state, value) {
    return state.selected_site = value
  },
  Update_Selected_Site_2(state, value) {
    return state.selected_site_2 = value
  },
  Update_Selected_Site_3(state, value) {
    return state.selected_site_3 = value
  },
  Update_Run_Index(state, value) {
    return state.run_index += value
  },
  Update_Data_Index(state, value) {
    return state.data_index += value
  },
  Update_src_path(state, value) {
    return state.src_path = value
  },
  Update_PathData(state, value) {
    return state.pathData = value
  },
  Update_PathData_2(state, value) {
    return state.pathData_2 = value
  },

}
const actions = {

  fetchCitys({
    commit
  }) {
    axiosInstance.get("http://127.0.0.1/api/site_dataCity")
      .then(res => {
        commit('FETCH_Citys', res.data);
        console.log("vuex-get 城市");

      })
      .catch(err => {
        console.log(err);
      })
  },

  fetchSites({
    commit
  }) {
    axiosInstance.post("http://127.0.0.1/api/sitesByCity", {
        city_name: state.selected_city,
      })
      .then(res => {
        commit('FETCH_Sites', res.data);
        console.log("vuex-post api取景點資料");
      })
      .catch(err => {
        console.log(err);
      });
  },

  fetchProsConsR({
    commit,
    dispatch
  }) {
    axiosInstance.post("http://127.0.0.1/api/proscons", {
        name: state.selected_site,
      })
      .then(res => {
        console.log("執行優缺分析完成，產生good,bad.html ");
        // 讓R執行數
        commit('Update_Run_Index', 1);

      })
      .catch(err => {
        console.log(err);
      });
  },
  //
  fetchPath({
    commit,
  }) {
    axiosInstance.post("http://127.0.0.1/api/PathData", {
        name: state.selected_site,
      })
      .then(res => {
        console.log("取得第一層景點");
        commit('Update_PathData', res);

      })
      .catch(function(response) {
        console.log(response);
      });

  },
//
  fetchPath_2({
    commit,
  }) {
    axiosInstance.post("http://127.0.0.1/api/PathData", {
        name: state.selected_site_2,
      })
      .then(res => {
        console.log("取得第二層景點");
        commit('Update_PathData_2', res);

      })
      .catch(function(response) {
        console.log(response);
      });

  },
}

const getters = {

  citys: (state) => {
    return state.citys;
  },
  sites: (state) => {
    return state.sites;
  },

  selected_city: (state) => {
    return state.selected_city;
  },
  selected_site: (state) => {
    return state.selected_site;
  },
  selected_site_2: (state) => {
    return state.selected_site_2;
  },
  selected_site_3: (state) => {
    return state.selected_site_3;
  },
  run_index: (state) => {
    return state.run_index;
  },
  data_index: (state) => {
    return state.data_index;
  },
  src_path: (state) => {
    return state.src_path;
  },
  pathData: (state) => {
    return state.pathData;
  },
  pathData_2: (state) => {
    return state.pathData_2;
  },

}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}