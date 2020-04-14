import Vue from "vue";
import { fstore, firebaseAuth } from "boot/firebase";
import { uid } from "quasar";

const state = {
  name: "PageIndex1",
  slide: "style",
  expend: false,
  sightseeingMembers: {},
  everydaySites: {},
  watch: {}
};
const mutations = {
  updateSchedule(state, payload) {
    // console.log("payload (from mutation)", payload);
    // Object.assign(state.sightseeingMembers[payload.id], payload.updates);
  },
  updateDragSite(state, payload) {
    // console.log("payload (from mutation)", payload.updates);
    state.everydaySites.id = payload.id;
    state.everydaySites.site = payload;
    // Array.assign(state.everydaySites[payload.id], payload.updates);
  },
  addSchedule(state, payload) {
    // Vue.set(state.sightseeingMembers, payload.id, payload.sightseeingMember);
    state.sightseeingMembers = payload;
  },
  deleteSchedule(state, id) {
    // console.log("delete", id);
    // delete state.schedules[id];
    Vue.delete(state.sightseeingMembers, id);
  },
  addEverydaySite(state, everyday) {
    // state.everydaySites = everyday;
    Vue.set(state.everydaySites, everyday.id, everyday.everyday);

    console.log("資料格式", everyday);
  },
  setDragkey(state, everydaySite) {
    state.everydaySites = everydaySite;
    // console.log("setDragkey", state.everydaySites);
  },
  setDragGroup(state, { value, key }) {
    state.everydaySites[key].site = value;
  }
};
const actions = {
  updateSchedule({ commit, dispatch }, payload) {
    commit("updateSchedule", payload);

    // 傳id給arrange-schedule
    const pass_id = payload.id;
    this.$router.push({
      path: "/arrange-schedule?",
      query: { pass_id: `${pass_id}` }
    });
    dispatch("fbEverySiteData", pass_id);
  },
  updateDragSite({ commit }, payload) {
    // console.log("updateDragSite", payload);
    commit("updateDragSite", payload);
  },
  deleteSchedule({ commit }, id) {
    console.log(id);
    commit("deleteSchedule", id);
  },
  setDragkey({ commit }, value) {
    commit("setDragkey", value);
  },
  storeEverydaySites(context) {
    let jsonPages = JSON.parse(JSON.stringify(context.state.everydaySites));
    // console.log("jsonPages:", jsonPages);
  },
  fbReadData({ commit }) {
    const uid = firebaseAuth.currentUser.uid;
    // const name = firebaseAuth.currentUser.name;
    const payload = [];
    const userSchedule = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的旅程表");

    userSchedule.get().then(function(querySnapshot) {
      querySnapshot.forEach(function(doc) {
        var sightseeingMember = doc.data();
        var id = doc.id;

        payload.push({
          id: id,
          title: sightseeingMember.title,
          date: sightseeingMember.date
          // sightseeingMember: sightseeingMember
        });
      });
      commit("addSchedule", payload);
    });
  },
  // fbEverySiteData({ commit }, pass_id) {
  //   const uid = firebaseAuth.currentUser.uid;
  //   const everyday = [];
  //   const itinerary_eve = fstore
  //     .collection("sightseeingMember")
  //     .doc(uid)
  //     .collection("我的旅程表")
  //     .doc(pass_id)
  //     .collection("每一天");
  //   itinerary_eve.get().then(function(querySnapshot) {
  //     querySnapshot.forEach(function(doc) {
  //       // console.log("every", doc.data());
  //       // console.log("every", doc.id);
  //       var everydaySite = doc.data();
  //       var everydayId = doc.id;
  //       everyday.push({
  //         id: everydayId,
  //         site: everydaySite.site
  //         // date: everydaySite.date
  //       });
  //     });
  //     // console.log(everyday);

  //     commit("addEverydaySite", everyday);
  //   });
  // }
  fbEverySiteData({ commit }, pass_id) {
    const uid = firebaseAuth.currentUser.uid;
    // const everyday = [];
    const itinerary_eve = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的旅程表")
      .doc(pass_id)
      .collection("每一天");
    itinerary_eve.onSnapshot(snapshot => {
      snapshot.forEach(doc => {
        commit("addEverydaySite", {
          id: doc.id,
          everyday: doc.data()
        });
      });
    });
  }
};
const getters = {
  // sightseeingMember: state => {
  //   return state.sightseeingMembers;
  // }
  sightseeingMembers: state => {
    return state.sightseeingMembers;
  },
  everydaySites: state => {
    return state.everydaySites;
  }
};
export default {
  namespaced: true,

  state,
  mutations,
  actions,
  getters
};
