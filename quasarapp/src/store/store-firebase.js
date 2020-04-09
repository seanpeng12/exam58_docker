import Vue from "vue";
import { fstore, firebaseAuth } from "boot/firebase";

const state = {
  name: "PageIndex1",
  slide: "style",
  expend: false,
  sightseeingMembers: [],
  watch: {}
};
const mutations = {
  addSchedule(state, payload) {
    // Vue.set(state.sightseeingMembers, payload.id, payload.sightseeingMember);
    state.sightseeingMembers = payload;
  }
};
const actions = {
  updateSchedule({ commit }, payload) {
    commit("updateSchedule", payload);
  },

  fbReadData({ commit }) {
    const uid = firebaseAuth.currentUser.uid;
    // const name = firebaseAuth.currentUser.name;
    const payload = [];
    fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的旅程表")
      .get()
      .then(function(querySnapshot) {
        querySnapshot.forEach(function(doc) {
          var sightseeingMember = doc.data();
          var id = doc.id;
          console.log(sightseeingMember);

          payload.push({
            id: id,
            title: sightseeingMember.title,
            date: sightseeingMember.date
          });
        });
        commit("addSchedule", payload);
      });
  }
};
const getters = {
  // sightseeingMember: state => {
  //   return state.sightseeingMembers;
  // }
  sightseeingMembers: state => {
    return state.sightseeingMembers;
  }
};
export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
};
