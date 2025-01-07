import axios, { axiosInstance } from "boot/axios";
import Vue from "vue";
import { fstore, firebaseAuth, firebaseApp, firestore } from "boot/firebase";

const state = {
  namespaced: true,
  // site-demand
  // 選單選擇資料
  selected_p: "",
  selected_p_detail_item: "",
  selected_p_detail_item_2: "",

  // 選單城市資料(axios用)
  citys: [],
  // 選單類別資料(axios用)
  cats: [],

  // 懶人包景點資料(預設假資料)
  // txtdatas: [{
  //   id: 1,
  //   name: "並將喜好項目勾選(此為預設)",
  //   completed: "0"
  // }],
  txtdatas: {},
  // 差集
  txtdatas_diff2: {},
  txtdatas_diff3: {},
  // 提示：
  txtinfo: "請先選擇城市與需求",

  //src iframe
  // src: "./statics/between_relationship.html",
  src: "http://140.136.155.116:8080/statics/between_relationship.html",
  // R
  Rdata: {},
  // 用以偵測是否按下按鈕(累積)
  runR_value: 0,
  //用以判斷跑完R(累積)
  after_axios: 0,

  // v-show
  txtdatas_ok: false,
  txtdatas_diff_ok: false,

  // google
  site_name: "",
  Gdata: {
    opening_hours: {
      open_now: false,
      weekday_text: null
    },
    rating: 0,
    rating_total: 0,
    name: null,
    address: null,
    photos: [
      {
        url: "https://cdn.quasar.dev/img/parallax2.jpg"
      }
    ]
  }
};
const mutations = {
  FETCH_citys(state, citys) {
    return (state.citys = citys);
  },
  FETCH_cats(state, cats) {
    return (state.cats = cats);
  },
  FETCH_Rdata(state, res) {
    return (state.Rdata = res);
  },
  FETCH_txtdatas(state, res) {
    Vue.set(state.txtdatas, res.id, res.txtdata);

    // console.log("FETCH_txtdatas from mutation:", state.txtdatas);

    // return state.txtdatas = res
  },
  FETCH_site_name(state, res) {
    return (state.site_name = res);
  },
  FETCH_Gdata(state, res) {
    return (state.Gdata = res);
  },
  resetTxtdatas(state) {
    // console.log("reset");
    // Vue.set(state.txtdatas, null, null);
    state.txtdatas = {};
    // console.log(state.txtdatas);
  },
  resetTxtdatas_diff2(state) {
    // console.log("reset");
    // Vue.set(state.txtdatas, null, null);
    state.txtdatas_diff2 = {};
    // console.log(state.txtdatas);
  },
  resetTxtdatas_diff3(state) {
    // console.log("reset");
    // Vue.set(state.txtdatas, null, null);
    state.txtdatas_diff3 = {};
    // console.log(state.txtdatas);
  },
  FETCH_txtdatas_diff2(state, res) {
    Vue.set(state.txtdatas_diff2, res.id, res.txtdata_diff2);

    // console.log("FETCH_txtdatas_diff2 from mutation:", state.txtdatas_diff2);
  },
  FETCH_txtdatas_diff3(state, res) {
    Vue.set(state.txtdatas_diff3, res.id, res.txtdata_diff3);

    console.log("FETCH_txtdatas_diff3 from mutation:", state.txtdatas_diff3);
  },
  FETCH_index(state, index) {
    return (state.after_axios += index);
  },
  update_selected_p(state, value) {
    console.log("update_selected_p", value);

    return (state.selected_p = value);
  },
  update_selected_p_detail_item(state, value) {
    console.log(value);

    return (state.selected_p_detail_item = value);
  },
  update_selected_p_detail_item_2(state, value) {
    console.log(value);

    return (state.selected_p_detail_item_2 = value);
  },
  update_txtdatas(state, value) {
    return (state.txtdatas = value);
  },
  update_runR_value(state, value) {
    return (state.runR_value += value);
  },
  update_txtinfo(state, value) {
    return (state.txtinfo = value);
  },
  update_src(state, value) {
    return (state.src = value);
  },
  update_txtdatas_ok(state, value) {
    return (state.txtdatas_ok = value);
  },
  update_txtdatas_diff_ok(state, value) {
    return (state.txtdatas_diff_ok = value);
  }
};
const actions = {
  fetchCitys({ commit }) {
    axiosInstance
      .get("http://140.136.155.116/api/site_dataCity")
      .then(res => {
        commit("FETCH_citys", res.data);
        console.log("vuex-觸發city值");
        // this.citys = response.data;
        // console.log("成功");
      })
      .catch(err => {
        console.log(err);
      });
  },

  fetchCats({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/site_dataCat", {
        name: state.selected_p
      })
      .then(res => {
        commit("FETCH_cats", res.data);
        console.log("vuex-觸發第二層");
      })
      .catch(err => {
        console.log(err);
      });
  },

  // upload_axios({
  //   commit
  // }) {
  //   axiosInstance
  //     .post("http://127.0.0.1:80/api/runR_twoC", {
  //       name: state.selected_p,
  //       c1: state.selected_p_detail_item,
  //       c20: state.selected_p_detail_item_2
  //     })
  //     .then(response => {
  //       console.log("成功");
  //       console.log(response.data);
  //       commit('FETCH_Rdata', response.data);
  //       commit('FETCH_index', 1);
  //     })
  //     .catch(function (response) {
  //       console.log(response);
  //     });

  //   // axiosInstance.all([
  //   //   axiosInstance.post("http://127.0.0.1:80/api/runR_twoC", {
  //   //     name: state.selected_p,
  //   //     c1: state.selected_p_detail_item,
  //   //     c20: state.selected_p_detail_item_2}),
  //   //     axiosInstance.post("http://127.0.0.1:80/api/cat", {
  //   //     name: state.selected_p,
  //   //     c1: state.selected_p_detail_item,
  //   //     c20: state.selected_p_detail_item_2}),
  //   // ])
  //   // .then(axiosInstance.spread((response1, response2) => {

  //   //   // this.state.Rdata = response1.data
  //   //   console.log("vuex-twoC?????");
  //   //   console.log(response1.data);
  //   //   // commit('FETCH_Rdata', response1.data);
  //   //   // commit('FETCH_txtdata', response2.data);
  //   //   // commit('FETCH_index', 1);
  //   //   // this.Rdata = response1.data;
  //   //   // this.txtdata = response2.data;
  //   //   // 更改iframe src
  //   //   // this.changeSrc();
  //   //   // this.src = "./statics/between_relationship.html";
  //   //   console.log("成功!~~~~~~~~~~~~~~~~~");
  //   // })).catch(function(response) {
  //   //     console.log(response);
  //   //   });
  // },
  // ajax跑R圖
  upload_axios({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/runR_twoC", {
        name: state.selected_p,
        c1: state.selected_p_detail_item,
        c20: state.selected_p_detail_item_2
      })
      .then(response => {
        console.log("成功R");
        console.log(response.data);
        commit("FETCH_Rdata", response.data);

        commit("FETCH_index", 1);
        console.log("after_axios+1");
      })
      .catch(function(response) {
        console.log(response);
      });
  },
  // ajax取懶人包資料
  upload_axios_2({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/cat", {
        name: state.selected_p,
        c1: state.selected_p_detail_item,
        c20: state.selected_p_detail_item_2
      })
      .then(response => {
        console.log("成功2");
        // console.log(response.data);
        const id = response.data.map(item => item.id);
        const name = response.data.map(item => item.name);
        const city_name = response.data.map(item => item.city_name);
        const address = response.data.map(item => item.address);
        const comment = response.data.map(item => item.comment);
        const rate = response.data.map(item => item.rate);
        const type = response.data.map(item => item.type);
        firebaseAuth.onAuthStateChanged(user => {
          // 如果登入，判斷是否收入收藏
          if (user) {
            const uid = firebaseAuth.currentUser.uid;
            const checkCollectionExists = fstore
              .collection("sightseeingMember")
              .doc(uid)
              .collection("我的收藏");
            id.forEach(function(data, index, array) {
              checkCollectionExists
                .doc(data)
                .get()
                .then(function(doc) {
                  if (index === id.length - 1) {
                    commit("update_txtdatas_ok", true);
                    console.log("site:txtdatas最後一筆(登入會員)");
                    if (doc.exists) {
                      commit("FETCH_txtdatas", {
                        id: data,
                        txtdata: {
                          name: name[index],
                          city_name: city_name[index],
                          address: address[index],
                          comment: comment[index],
                          rate: rate[index],
                          type: type[index],
                          exists: true
                        }
                      });
                    } else {
                      commit("FETCH_txtdatas", {
                        id: data,
                        txtdata: {
                          name: name[index],
                          city_name: city_name[index],
                          address: address[index],
                          comment: comment[index],
                          rate: rate[index],
                          type: type[index],
                          exists: false
                        }
                      });
                    }
                  } else {
                    if (doc.exists) {
                      commit("FETCH_txtdatas", {
                        id: data,
                        txtdata: {
                          name: name[index],
                          city_name: city_name[index],
                          address: address[index],
                          comment: comment[index],
                          rate: rate[index],
                          type: type[index],
                          exists: true
                        }
                      });
                    } else {
                      commit("FETCH_txtdatas", {
                        id: data,
                        txtdata: {
                          name: name[index],
                          city_name: city_name[index],
                          address: address[index],
                          comment: comment[index],
                          rate: rate[index],
                          type: type[index],
                          exists: false
                        }
                      });
                    }
                  }
                })
                .catch(function(error) {
                  console.log("Error getting document:", error);
                });
            });
          } else {
            // console.log("not login");
            id.forEach(function(data, index, array) {
              if (index === id.length - 1) {
                commit("update_txtdatas_ok", true);
                console.log("site:txtdatas最後一筆(未登入)");
                commit("FETCH_txtdatas", {
                  id: data,
                  txtdata: {
                    name: name[index],
                    city_name: city_name[index],
                    address: address[index],
                    comment: comment[index],
                    rate: rate[index],
                    type: type[index]
                  }
                });
              } else {
                commit("FETCH_txtdatas", {
                  id: data,
                  txtdata: {
                    name: name[index],
                    city_name: city_name[index],
                    address: address[index],
                    comment: comment[index],
                    rate: rate[index],
                    type: type[index]
                  }
                });
              }
            });
          }
        });
        // console.log("txtdatas from actions", txtdatas);

        // commit('FETCH_txtdatas', txtdatas);
      })
      .catch(function(response) {
        console.log(response);
      });
  },
  // test
  test_axios_2_diff({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/new_cat_diff", {
        name: "台北",
        c1: "建築物",
        c20: "古蹟"
      })
      .then(response => {
        console.log("test_axios_2_diff建築物", response.data["建築物"]);
        console.log(
          "test_axios_2_diff古蹟",
          response.data["古蹟"].map(item => item.id)
        );
        // const id = response.data.map(item => item.id);
        // const name = response.data.map(item => item.name);
        // const city_name = response.data.map(item => item.city_name);
        // const address = response.data.map(item => item.address);
        // const comment = response.data.map(item => item.comment);
        // const rate = response.data.map(item => item.rate);
        // const type = response.data.map(item => item.type);
        // const tag = response.data.map(item => item.tag);
      });
  },
  // test end
  // 取差集diff
  upload_axios_2_diff({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/new_cat_diff", {
        name: state.selected_p,
        c1: state.selected_p_detail_item,
        c20: state.selected_p_detail_item_2
      })
      .then(response => {
        console.log("response", response);
        const id = response.data[state.selected_p_detail_item].map(
          item => item.id
        );
        const name = response.data[state.selected_p_detail_item].map(
          item => item.name
        );
        const city_name = response.data[state.selected_p_detail_item].map(
          item => item.city_name
        );
        const address = response.data[state.selected_p_detail_item].map(
          item => item.address
        );
        const comment = response.data[state.selected_p_detail_item].map(
          item => item.comment
        );
        const rate = response.data[state.selected_p_detail_item].map(
          item => item.rate
        );

        const type = response.data[state.selected_p_detail_item].map(
          item => item.type
        );
        const tag = response.data[state.selected_p_detail_item].map(
          item => item.tag
        );
        firebaseAuth.onAuthStateChanged(user => {
          // console.log("test", id, city_name);
          // 如果登入，判斷是否收入收藏
          if (user) {
            // console.log("site:成功取diff");
            // console.log(response.data);
            const uid = firebaseAuth.currentUser.uid;
            const checkCollectionExists = fstore
              .collection("sightseeingMember")
              .doc(uid)
              .collection("我的收藏");
            id.forEach(function(data, index, array) {
              console.log("foreach name[index]", city_name[index]);

              checkCollectionExists
                .doc(data)
                .get()
                .then(function(doc) {
                  if (index === id.length - 1) {
                    commit("update_txtdatas_diff_ok", true);
                    console.log("site:txtdatas_diff2最後一筆(登入會員)");
                    if (doc.exists) {
                      commit("FETCH_txtdatas_diff2", {
                        id: data,
                        txtdata_diff2: {
                          name: name[index],
                          city_name: city_name[index],
                          address: address[index],
                          comment: comment[index],
                          rate: rate[index],
                          type: type[index],
                          tag: tag[index],
                          exists: true
                        }
                      });
                    } else {
                      commit("FETCH_txtdatas_diff2", {
                        id: data,
                        txtdata_diff2: {
                          name: name[index],
                          city_name: city_name[index],
                          address: address[index],
                          comment: comment[index],
                          rate: rate[index],
                          type: type[index],
                          tag: tag[index],
                          exists: false
                        }
                      });
                    }
                  } else {
                    // 判斷資料是否存在資料庫
                    if (doc.exists) {
                      commit("FETCH_txtdatas_diff2", {
                        id: data,
                        txtdata_diff2: {
                          name: name[index],
                          city_name: city_name[index],
                          address: address[index],
                          comment: comment[index],
                          rate: rate[index],
                          type: type[index],
                          tag: tag[index],
                          exists: true
                        }
                      });
                    } else {
                      commit("FETCH_txtdatas_diff2", {
                        id: data,
                        txtdata_diff2: {
                          name: name[index],
                          city_name: city_name[index],
                          address: address[index],
                          comment: comment[index],
                          rate: rate[index],
                          type: type[index],
                          tag: tag[index],
                          exists: false
                        }
                      });
                    }
                  }
                })
                .catch(function(error) {
                  console.log("Error getting document:", error);
                });
            });
          }
          // 未登入，不判斷資料是否存在資料庫
          else {
            id.forEach(function(data, index, array) {
              if (index === id.length - 1) {
                commit("update_txtdatas_diff_ok", true);
                console.log("site:txtdatas_diff2最後一筆(未登入)");
                commit("FETCH_txtdatas_diff2", {
                  id: data,
                  txtdata_diff2: {
                    name: name[index],
                    city_name: city_name[index],
                    address: address[index],
                    comment: comment[index],
                    rate: rate[index],
                    type: type[index],
                    tag: tag[index]
                  }
                });
              } else {
                commit("FETCH_txtdatas_diff2", {
                  id: data,
                  txtdata_diff2: {
                    name: name[index],
                    city_name: city_name[index],
                    address: address[index],
                    comment: comment[index],
                    rate: rate[index],
                    type: type[index],
                    tag: tag[index]
                  }
                });
              }
            });
          }
        });
      })

      .catch(function(response) {
        console.log(response);
      });
  },
  // 聯集2
  upload_axios_3_diff({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/new_cat_diff", {
        name: state.selected_p,
        c1: state.selected_p_detail_item,
        c20: state.selected_p_detail_item_2
      })
      .then(response => {
        const id = response.data[state.selected_p_detail_item_2].map(
          item => item.id
        );
        const name = response.data[state.selected_p_detail_item_2].map(
          item => item.name
        );
        const city_name = response.data[state.selected_p_detail_item_2].map(
          item => item.city_name
        );
        const address = response.data[state.selected_p_detail_item_2].map(
          item => item.address
        );
        const comment = response.data[state.selected_p_detail_item_2].map(
          item => item.comment
        );
        const rate = response.data[state.selected_p_detail_item_2].map(
          item => item.rate
        );

        const type = response.data[state.selected_p_detail_item_2].map(
          item => item.type
        );
        const tag = response.data[state.selected_p_detail_item_2].map(
          item => item.tag
        );
        firebaseAuth.onAuthStateChanged(user => {
          // 如果登入，判斷是否收入收藏
          if (user) {
            // console.log("site:成功取diff");
            // console.log(response.data);
            const uid = firebaseAuth.currentUser.uid;
            const checkCollectionExists = fstore
              .collection("sightseeingMember")
              .doc(uid)
              .collection("我的收藏");
            id.forEach(function(data, index, array) {
              checkCollectionExists
                .doc(data)
                .get()
                .then(function(doc) {
                  if (index === id.length - 1) {
                    commit("update_txtdatas_diff_ok", true);
                    console.log("site:txtdatas_diff3最後一筆(登入會員)");
                    if (doc.exists) {
                      commit("FETCH_txtdatas_diff3", {
                        id: data,
                        txtdata_diff: {
                          name: name[index],
                          city_name: city_name[index],
                          address: address[index],
                          comment: comment[index],
                          rate: rate[index],
                          type: type[index],
                          tag: tag[index],
                          exists: true
                        }
                      });
                    } else {
                      commit("FETCH_txtdatas_diff3", {
                        id: data,
                        txtdata_diff3: {
                          name: name[index],
                          city_name: city_name[index],
                          address: address[index],
                          comment: comment[index],
                          rate: rate[index],
                          type: type[index],
                          tag: tag[index],
                          exists: false
                        }
                      });
                    }
                  } else {
                    // 判斷資料是否存在資料庫
                    if (doc.exists) {
                      commit("FETCH_txtdatas_diff3", {
                        id: data,
                        txtdata_diff3: {
                          name: name[index],
                          city_name: city_name[index],
                          address: address[index],
                          comment: comment[index],
                          rate: rate[index],
                          type: type[index],
                          tag: tag[index],
                          exists: true
                        }
                      });
                    } else {
                      commit("FETCH_txtdatas_diff3", {
                        id: data,
                        txtdata_diff3: {
                          name: name[index],
                          city_name: city_name[index],
                          address: address[index],
                          comment: comment[index],
                          rate: rate[index],
                          type: type[index],
                          tag: tag[index],
                          exists: false
                        }
                      });
                    }
                  }
                })
                .catch(function(error) {
                  console.log("Error getting document:", error);
                });
            });
          }
          // 未登入，不判斷資料是否存在資料庫
          else {
            id.forEach(function(data, index, array) {
              if (index === id.length - 1) {
                commit("update_txtdatas_diff_ok", true);
                console.log("site:txtdatas_diff3最後一筆(未登入)");
                commit("FETCH_txtdatas_diff3", {
                  id: data,
                  txtdata_diff3: {
                    name: name[index],
                    city_name: city_name[index],
                    address: address[index],
                    comment: comment[index],
                    rate: rate[index],
                    type: type[index],
                    tag: tag[index]
                  }
                });
              } else {
                commit("FETCH_txtdatas_diff3", {
                  id: data,
                  txtdata_diff3: {
                    name: name[index],
                    city_name: city_name[index],
                    address: address[index],
                    comment: comment[index],
                    rate: rate[index],
                    type: type[index],
                    tag: tag[index]
                  }
                });
              }
            });
          }
        });
      })

      .catch(function(response) {
        console.log(response);
      });
  },
  resetTxtdatas({ commit }) {
    commit("resetTxtdatas");
    commit("resetTxtdatas_diff2");
    commit("resetTxtdatas_diff3");
  },
  fetchInfo({ commit }) {
    axiosInstance
      .post("http://140.136.155.116/api/demand_info", {
        name: state.site_name
      })
      .then(response => {
        console.log("成功取Gdata");
        console.log(response.data);
        commit("FETCH_Gdata", response.data);
      })
      .catch(function(response) {
        console.log("發生錯誤", response);
      });
  }
};
const getters = {
  citys: state => {
    return state.citys;
  },
  cats: state => {
    return state.cats;
  },
  txtdatas_diff2: state => {
    return state.txtdatas_diff2;
  },
  txtdatas_diff3: state => {
    return state.txtdatas_diff3;
  },
  txtdatas: state => {
    return state.txtdatas;
  },
  src: state => {
    return state.src;
  },
  Rdata: state => {
    return state.Rdata;
  },

  selected_p: state => {
    return state.selected_p;
  },
  selected_p_detail_item: state => {
    return state.selected_p_detail_item;
  },
  selected_p_detail_item_2: state => {
    return state.selected_p_detail_item_2;
  },
  product_lists: state => {
    return state.product_lists;
  },
  product_detail: state => {
    return state.product_detail;
  },
  after_axios: state => {
    return state.after_axios;
  },
  runR_value: state => {
    return state.runR_value;
  },
  txtinfo: state => {
    return state.txtinfo;
  },
  txtdatas_ok: state => {
    return state.txtdatas_ok;
  },
  txtdatas_diff_ok: state => {
    return state.txtdatas_diff_ok;
  },
  site_name: state => {
    return state.site_name;
  },
  Gdata: state => {
    return state.Gdata;
  }
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
};
