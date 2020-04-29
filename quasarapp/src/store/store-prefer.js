import axios, { axiosInstance } from "boot/axios";
import Vue from "vue";
import { fstore, firebaseAuth, firebaseApp, firestore } from "boot/firebase";
import { uid } from "quasar";
import { loadGmapApi } from "vue2-google-maps/dist/manager";

const state = {
  name: "PageIndex1",
  slide: "style",
  expend: false,
  prefer: {},
  firstPrefers: {},
  watch: {}
};
const mutations = {
  firstPrefer(state, payload) {
    state.firstPrefers = payload;
    // console.log("firstPrefer", payload);
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
        // console.log(doc.data());

        commit("addCollection", {
          id: doc.id,
          collection: doc.data()
        });
      });
    });
  },
  searchPrefer({ commit }) {
    const uid = firebaseAuth.currentUser.uid;
    console.log("fbReadData", uid);
    const userPrefer = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("偏好分析");

    const time = userPrefer.orderBy("time", "desc").limit(2);
    time.get().then(querySnapshot => {
      if (!querySnapshot.empty) {
        //We know there is one doc in the querySnapshot
        const prefer_1 = querySnapshot.docs[0];
        const prefer_2 = querySnapshot.docs[1];

        commit("demand/update_selected_p_detail_item", prefer_1.id, {
          root: true
        });
        commit("demand/update_selected_p_detail_item_2", prefer_2.id, {
          root: true
        });
        return prefer_1, prefer_2;
      } else {
        console.log("No document corresponding to the query!");
        return null;
      }
    });
    // console.log("time", time);

    // userPrefer.onSnapshot(Snapshot => {
    //   Snapshot.forEach(doc => {
    //     // commit("addCollection", {
    //     //   id: doc.id,
    //     //   collection: doc.data()
    //     // });
    //   });
    // });
  }
};
const getters = {
  firstPrefer: state => {
    return state.firstPrefers;
  }
};
export default {
  namespaced: true,

  state,
  mutations,
  actions,
  getters
};
