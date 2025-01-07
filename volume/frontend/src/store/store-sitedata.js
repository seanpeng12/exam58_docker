import axios, { axiosInstance } from 'boot/axios'

const state = {
  // 測試(cardview.vue)
  posts: [],
  post: {
    id: "",
    name: "",
    city_name: "",
    address: "",
    type: "",
    comment: null,
    rate: 0,
    href: "",
    color: "",
    shape: ""
  },
  // 測試
  sitedata: {
    'ID1': {
      name: "go to sleep",
      completed: false,
      time: "19:33"
    },
    'ID2': {
      name: "go to wake",
      completed: false,
      time: "19:30"
    }
  },

}
const mutations = {
  updateTask(state, payload) {
    console.log('payload from mutation:', payload);
    Object.assign(state.sitedata[payload.id], payload.updates)
  },
  FETCH_posts(state, posts) {
    return state.posts = posts
  },


}
const actions = {
  updateTask({ commit }, payload) {
    // console.log('updateTask action');
    // console.log('payload: ',payload);
    commit('updateTask', payload)
  },

  fetchPosts({ commit }) {
    axiosInstance.get('http://140.136.155.116/api/site_data')
      .then(res => {
        commit('FETCH_posts', res.data);
        console.log("vuex-觸發site_data值");

      }).catch(err => {
        console.log(err);
      })
  },




}
const getters = {
  getSiteData: (state) => {
    return state.sitedata;
  },
  posts: (state) => {
    return state.posts;
  },
  post: (state) => {
    return state.post;
  },


}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
}
