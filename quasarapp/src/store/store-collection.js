import Vue from "vue";
import { fstore, firebaseAuth, firebaseApp, firestore } from "boot/firebase";
import { uid } from "quasar";

const state = {
  name: "PageIndex1",
  slide: "style",
  expend: false,
  collections: {},
  watch: {}
};
const mutations = {
  addCollection(state, payload) {
    Vue.set(state.collections, payload.id, payload.collection);
    console.log("資料格式", payload);

    // state.sightseeingMembers = payload;
  }
};
const actions = {
  fbReadData({ commit }) {
    const uid = firebaseAuth.currentUser.uid;
    console.log("fbReadData", uid);
    const userCollection = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的收藏");

    userCollection.onSnapshot(Snapshot => {
      Snapshot.forEach(doc => {
        console.log(doc.data());

        commit("addCollection", {
          id: doc.id,
          collection: doc.data()
        });
      });
    });
  }
};
const getters = {
  collections: state => {
    return state.collections;
  }
};
export default {
  namespaced: true,

  state,
  mutations,
  actions,
  getters
};
