import axios, {
  axiosInstance
} from 'boot/axios'


const state = {
  namespaced: true,
  // 選單城市初始化資料
  citys: [],
  // 選單選擇資料
  selected_p: "",

  product_lists: ["台北", "高雄"],
  product_detail: {
    台北: ["博物館", "特色博物館", "台北3"],
    高雄: ["博物館", "古蹟", "高雄3"]
  },
  // 懶人包景點資料(預設假資料)
  txtdatas: [{
    id: 1,
    name: "並將喜好項目勾選(此為預設)",
    completed: false
  }],
  txtdata: {
    id: 0,
    name: "",
    completed: false
  },
  //src iframe
  src: "./statics/between_relationship.html",
  // R
  Rdata: {},
  //
  after_axios: 0,
}
const mutations = {

  FETCH_citys(state, citys) {
    return state.citys = citys
  },

  FETCH_Rdata(state, res) {
    return state.Rdata = res
  },
  FETCH_txtdatas(state, res) {
    return state.txtdatas = res
  },
  FETCH_index(state, index) {
    return state.after_axios += index
  },
  update_selected_p(state, value) {
    return state.selected_p = value
  },

}
const actions = {


  fetchCitys({
    commit
  }) {
    axiosInstance.get("http://127.0.0.1/api/site_dataCity")
      .then(res => {
        commit('FETCH_citys', res.data);
        console.log("vuex-觸發city值");
        // this.citys = response.data;
        // console.log("成功");
      })
      .catch(err => {
        console.log(err);
      })
  },


  upload_axios({
    commit
  }) {
    axiosInstance
      .post("http://127.0.0.1:80/api/runR_twoC", {
        name: state.selected_p,
        c1: state.selected_p_detail_item,
        c20: state.selected_p_detail_item_2
      })
      .then(response => {
        console.log("成功");
        console.log(response.data);
        commit('FETCH_Rdata', response.data);
        commit('FETCH_index', 1);
      })
      .catch(function (response) {
        console.log(response);
      });

  },
  upload_axios_2({
    commit
  }) {
    axiosInstance
      .post("http://127.0.0.1:80/api/cat", {
        name: state.selected_p,
        c1: state.selected_p_detail_item,
        c20: state.selected_p_detail_item_2
      })
      .then(response => {
        console.log("成功2");
        console.log(response.data);
        commit('FETCH_txtdatas', response.data);
      })
      .catch(function (response) {
        console.log(response);
      });
  }

}
const getters = {

  citys: (state) => {
    return state.citys;
  },
  txtdata: (state) => {
    return state.txtdata;
  },
  txtdatas: (state) => {
    return state.txtdatas;
  },
  src: (state) => {
    return state.src;
  },
  Rdata: (state) => {
    return state.Rdata;
  },

  selected_p: (state) => {
    return state.selected_p;
  },

  product_lists: (state) => {
    return state.product_lists;
  },
  product_detail: (state) => {
    return state.product_detail;
  },
  after_axios: (state) => {
    return state.after_axios;
  },
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
