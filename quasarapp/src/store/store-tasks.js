import Vue from "vue";
import { uid } from "quasar";
import { fstore, firebaseAuth } from "boot/firebase";
const state = {
  name: "PageIndex",
  slide: "style",
  expend: false,
  schedules: {
    ID1: {
      title: "我的花蓮之旅",
      startDate: "2020/01/21-2020/01/25"
    },
    ID2: {
      title: "台南行",
      startDate: "2020/01/21-2020/01/25"
    },
    ID3: {
      title: "五日花東遊",
      startDate: "2020/01/21-2020/01/25"
    }
  },
  //測試
  doc: {},
  watch: {
    vertical(val) {
      this.navPos = val === true ? "right" : "bottom";
    }
  }
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
  addSchedule(state, payload) {
    //Vue.set（對象(Object)，關鍵(key)， 值(value)）
    Vue.set(state.schedules, payload.id, payload.schedule);
  }
};

const actions = {
  updateSchedule({ commit }, payload) {
    commit("updateSchedule", payload);
  },
  deleteSchedule({ commit }, id) {
    commit("deleteSchedule", id);
  },
  addSchedule({ commit }, schedule) {
    let scheduleID = uid();
    let payload = {
      id: scheduleID,
      schedule: schedule
      // name: name,
    };
    commit("addSchedule", payload);
    console.log("schedule", payload.id);
    console.log("schedule", payload);
  },
  fbReadData({ commit }) {
    // console.log("start reading fb");
    // console.log(firebaseAuth.currentUser);
    const uid = firebaseAuth.currentUser.uid;
    // const name = firebaseAuth.currentUser.name;
    //測試
    // fstore
    //   .collection("sightseeingMember")
    //   .doc(uid)
    //   .onSnapshot(function(doc) {
    //     // console.log(doc.data());
    //     let payload = {
    //       uid: uid,
    //       doc: doc.data()
    //       // name: name,
    //     };
    //     // commit("addUserName", payload);
    //   });
  },
  reveal() {
    console.log("reveal");
  }
};
const getters = {
  schedules: state => {
    return state.schedules;
  }
};
export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
};
