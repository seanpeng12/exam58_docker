import Vue from "vue";
import { fstore, firebaseAuth, firebaseApp, firestore } from "boot/firebase";
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
    console.log("payload (from mutation)", payload);
    // Object.assign(state.sightseeingMembers[payload.id], payload.updates);
  },
  updateDragSite(state, payload) {
    // console.log("payload (from mutation)", payload.updates);
    // state.everydaySites.id = payload.id;
    // state.everydaySites.site = payload;
    // Array.assign(state.everydaySites[payload.id], payload.updates);
  },
  addSchedule(state, payload) {
    Vue.set(state.sightseeingMembers, payload.id, payload.sightseeingMember);
    // console.log("資料格式", payload);

    // state.sightseeingMembers = payload;
  },
  deleteSchedule(state, id) {
    // console.log("delete", id);
    // delete state.schedules[id];
    Vue.delete(state.sightseeingMembers, id);
  },
  deleteEveryDay(state, id) {
    // console.log("delete", id);
    // delete state.schedules[id];
    Vue.delete(state.everydaySites, id);
    console.log("deleteEveryDay", id);
  },
  addEverydaySite(state, everyday) {
    // state.everydaySites = everyday;
    Vue.set(state.everydaySites, everyday.id, everyday.everyday);
    // console.log("資料格式", everyday);
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
    const uid = firebaseAuth.currentUser.uid;

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
  deleteSchedule({ commit, dispatch }, id) {
    // commit("deleteSchedule", id);
    dispatch("fbDeleteData", id);
    // console.log("deleteSchedule from mutation", id);
  },
  deleteEveryDaySite({ commit, dispatch }, payload) {
    // commit("deleteSchedule", payload);
    dispatch("fbDeleteEverySiteData", payload);
    // console.log("deleteEveryDaySite from mutation", payload);
  },
  setDragkey({ commit }, value) {
    commit("setDragkey", value);
  },
  storeEverydaySites(context) {
    // let jsonPages = JSON.parse(JSON.stringify(context.state.everydaySites));
    // console.log("jsonPages:", context.state.everydaySites);
  },
  fbReadData({ commit }) {
    const uid = firebaseAuth.currentUser.uid;
    // const name = firebaseAuth.currentUser.name;
    const userSchedule = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的旅程表");

    userSchedule.onSnapshot(addSnapshot => {
      addSnapshot.forEach(doc => {
        commit("addSchedule", {
          id: doc.id,
          sightseeingMember: doc.data()
        });
      });
    });

    // userSchedule.onSnapshot(removeSnapshot => {
    //   removeSnapshot.forEach(doc => {
    //     let id = doc.id;

    //     // commit("deleteSchedule", id);
    //     console.log("remove from action", id);
    //   });
    // });
  },
  fbAddData({ commit }, payload) {
    var moment = require("moment");

    const uid = firebaseAuth.currentUser.uid;
    var startDate = moment(payload.startDate).format("YYYY-MM-DD");

    const addData = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的旅程表")
      .doc();
    addData.set({
      title: payload.title,
      date: [startDate, ""]
    });
    addData
      .collection("每一天")
      .doc(startDate)
      .set({ site: [] });
  },
  fbDeleteData({ commit }, id) {
    const uid = firebaseAuth.currentUser.uid;

    const deleteData = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的旅程表")
      .doc(id);
    deleteData
      .delete()
      .then(function() {
        console.log("Document successfully deleted!");
        commit("deleteSchedule", id);
      })
      .catch(function(error) {
        console.error("Error removing document: ", error);
      });

    // deleteData.update({
    //   date: firestore.FieldValue.delete(),
    //   title: firestore.FieldValue.delete()
    // });
  },
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
          everyday: doc.data().site
        });
      });
    });
  },
  fbUpdateEverySiteData({ commit }, payload) {
    const uid = firebaseAuth.currentUser.uid;

    const updateDragSite = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的旅程表")
      .doc(payload.id)
      .collection("每一天");
    updateDragSite.doc(payload.key).set({
      site: payload.value
    });
    // itinerary_eve.onSnapshot(snapshot => {
    //   snapshot.forEach(doc => {
    //     commit("addEverydaySite", {
    //       id: doc.id,
    //       everyday: doc.data()
    //     });
    //   });
    // });
    console.log("fbUpdateEverySiteData:", payload.key);
  },
  fbAddEverySiteData({ commit }, payload) {
    const uid = firebaseAuth.currentUser.uid;

    const updateDragSite = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的旅程表")
      .doc(payload.scheduleId)
      .collection("每一天");
    updateDragSite.doc(payload.id).set({
      site: payload.everyday
    });
    commit("addEverydaySite", payload);
    console.log("fbUpdateEverySiteData:", payload);
  },
  fbDeleteEverySiteData({ commit }, payload) {
    const uid = firebaseAuth.currentUser.uid;
    const deDate = payload.value.date;
    const everydaySiteId = payload.id;

    const deSite = payload.value.site;
    const DeleteDragSite = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的旅程表")
      .doc(everydaySiteId)
      .collection("每一天")
      .doc(deDate);
    DeleteDragSite.update({
      site: firestore.FieldValue.arrayRemove(deSite)
    });
    console.log(deDate, deSite);
  },
  fbDeleteEveryday({ commit }, payload) {
    const uid = firebaseAuth.currentUser.uid;
    const deleteData = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的旅程表")
      .doc(payload.scheduleId)
      .collection("每一天")
      .doc(payload.id)
      .delete();

    deleteData
      .then(function() {
        console.log("Document successfully deleted!", payload.id);
        commit("deleteEveryDay", payload.id);
      })
      .catch(function(error) {
        console.error("Error removing document: ", error);
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
