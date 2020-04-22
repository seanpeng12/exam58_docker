import Vue from "vue";
import {
  fstore,
  firebaseAuth,
  firebaseApp,
  firestore
} from "boot/firebase";
import {
  uid
} from "quasar";

const state = {
  name: "PageIndex1",
  slide: "style",
  expend: false,
  collections: {},
  search: "",
  watch: {}
};
const mutations = {
  addCollection(state, payload) {
    Vue.set(state.collections, payload.id, payload.collection);
    // console.log("資料格式", payload);

    // state.sightseeingMembers = payload;
  },
  setSearch(state, value) {
    state.search = value;
  }
};
const actions = {
  fbReadData({
    commit
  }) {
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
  fbAddtoCollection({}, value) {
    const uid = firebaseAuth.currentUser.uid;

    const addToCollection = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的收藏").doc();

    addToCollection.set({
        site_name: value.city_name,
        id: value.id,

      })
      .then(function () {
        console.log("Document successfully written!");
      })
      .catch(function (error) {
        console.error("Error writing document: ", error);
      });

  },
  setSearch({
    commit
  }, value) {
    commit("setSearch", value);
  }
};
const getters = {
  // collections: state => {
  //   return state.collections;
  // }
  collectionsFiltered: state => {
    let collectionsFiltered = {};
    if (state.search) {
      Object.keys(state.collections).forEach(function (key) {
        let collection = state.collections[key],
          collectionNameLowerCase = collection.site_name.toLowerCase(),
          collectionCityLowerCase = collection.city.toLowerCase(),
          searchcollection = state.search.toLowerCase();
        if (
          collectionNameLowerCase.includes(searchcollection) ||
          collectionCityLowerCase.includes(searchcollection)
        ) {
          collectionsFiltered[key] = collection;
        }
      });
      return collectionsFiltered;
    }
    return state.collections;
  },
  collections: (state, getters) => {
    let collectionsFiltered = getters.collectionsFiltered;
    let collections = {};
    Object.keys(collectionsFiltered).forEach(function (key) {
      let collection = collectionsFiltered[key];

      collections[key] = collection;
    });
    return collections;
  }
};
export default {
  namespaced: true,

  state,
  mutations,
  actions,
  getters
};
