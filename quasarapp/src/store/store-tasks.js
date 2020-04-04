import Vue from "vue";
const state = {
  name: "PageIndex",
  slide: "style",
  expend: false,
  schedules: {
    ID1: {
      title: "我的花蓮之旅",
      date: "2020/01/21-2020/01/25",
    },
    ID2: {
      title: "台南行",
      date: "2020/01/21-2020/01/25",
    },
    ID3: {
      title: "五日花東遊",
      date: "2020/01/21-2020/01/25",
    },
  },
  watch: {
    vertical(val) {
      this.navPos = val === true ? "right" : "bottom";
    },
  },
};
const mutations = {
  updateSchedule(state, payload) {
    // console.log("payload (from mutation)", payload);
    Object.assign(state.schedules[payload.id], payload.updates);
  },
  deleteSchedule(state, id) {
    // console.log("delete", id);
    // delete state.schedules[id];
    Vue.delete(state.schedules, id);
  },
};
const actions = {
  updateSchedule({ commit }, payload) {
    commit("updateSchedule", payload);
  },
  deleteSchedule({ commit }, id) {
    commit("deleteSchedule", id);
  },
};
const getters = {
  schedules: (state) => {
    return state.schedules;
  },
};
export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters,
};
