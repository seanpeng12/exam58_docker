import axios, { axiosInstance } from 'boot/axios'


const state = {
  namespaced: true,
  // site-demand

  // 選單城市資料
  citys: [],
  // 選單選擇資料
  selected_p: "初始資料",
  selected_p_detail_item: "",
  selected_p_detail_item_2: "",
  product_lists: ["台北", "高雄"],
  product_detail: {
    台北: ["博物館", "特色博物館", "台北3"],
    高雄: ["博物館", "古蹟", "高雄3"]
  },
  // 懶人包景點資料(預設假資料)
  txtdatas: [
    {
      id: 1,
      name: "並將喜好項目勾選",
      completed : false
    }
  ],
  txtdata : {
      id: 0,
      name: "",
      completed : false
  },
  //src iframe
  src: "./statics/between_relationship.html",
  // R
  Rdata: {},
  //
  after_axios: 0,
}
const mutations = {

  FETCH_citys(state, citys){
    return state.citys = citys
  },

  FETCH_Rdata(state, res){
    return state.Rdata = res
  },
  FETCH_txtdata(state, res){
    return state.txtdata = res
  },
  FETCH_index(state, index){
    return state.after_axios = index
  },
  update_selected_p(state, value){
    return state.selected_p = value
  },
  update_selected_p_detail_item(state, value){
    return state.selected_p_detail_item = value
  },
  update_selected_p_detail_item_2(state, value){
    return state.selected_p_detail_item_2 = value
  },

}
const actions = {


  fetchCitys({commit}) {
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
  async upload_axios ({commit}) {
    const response = await axios.get('/days/')
    commit('setDays', response.data)
  },
  upload_axios({commit}) {
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
        .catch(function(response) {
          console.log(response);
        });


    // axiosInstance.all([
    //   axiosInstance.post("http://127.0.0.1:80/api/runR_twoC", {
    //     name: state.selected_p,
    //     c1: state.selected_p_detail_item,
    //     c20: state.selected_p_detail_item_2}),
    //     axiosInstance.post("http://127.0.0.1:80/api/cat", {
    //     name: state.selected_p,
    //     c1: state.selected_p_detail_item,
    //     c20: state.selected_p_detail_item_2}),
    // ])
    // .then(axiosInstance.spread((response1, response2) => {

    //   // this.state.Rdata = response1.data
    //   console.log("vuex-twoC?????");
    //   console.log(response1.data);
    //   // commit('FETCH_Rdata', response1.data);
    //   // commit('FETCH_txtdata', response2.data);
    //   // commit('FETCH_index', 1);
    //   // this.Rdata = response1.data;
    //   // this.txtdata = response2.data;
    //   // 更改iframe src
    //   // this.changeSrc();
    //   // this.src = "./statics/between_relationship.html";
    //   console.log("成功!~~~~~~~~~~~~~~~~~");
    // })).catch(function(response) {
    //     console.log(response);
    //   });
  }



}
const getters = {

  citys: (state) =>{
    return state.citys;
  },
  txtdata: (state) =>{
    return state.txtdata;
  },
  txtdatas: (state) =>{
    return state.txtdatas;
  },
  src:(state) =>{
    return state.src;
  },
  Rdata:(state) => {
    return state.Rdata;
  },

  selected_p:(state) => {
    return state.selected_p;
  },
  selected_p_detail_item:(state) => {
    return state.selected_p_detail_item;
  },
  selected_p_detail_item_2:(state) => {
    return state.selected_p_detail_item_2;
  },
  product_lists:(state) => {
    return state.product_lists;
  },
  product_detail:(state) => {
    return state.product_detail;
  },
  after_axios:(state) => {
    return state.after_axios;
  },
}

export default {
  namespaced :true,
  state,
  mutations,
  actions,
  getters
}
