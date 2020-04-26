import axios, { axiosInstance } from "boot/axios";
import Vue from "vue";
import { fstore, firebaseAuth, firebaseApp, firestore } from "boot/firebase";
import { uid } from "quasar";

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
  deleteCollection(state, id) {
    Vue.delete(state.collections, id);
  },
  setSearch(state, value) {
    state.search = value;
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
  fbAddtoCollection({}, value) {
    const uid = firebaseAuth.currentUser.uid;
    const collectionId = value.id;
    const addToCollection = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的收藏")
      .doc(collectionId);

    addToCollection
      .set({
        site_name: value.site_name,
        id: value.id,
        city: value.city_name,
        address: value.address,
        comment: value.comment,
        rate: value.rate
      })
      .then(function() {
        console.log("Document successfully written!");
      })
      .catch(function(error) {
        console.error("Error writing document: ", error);
      });
  },
  fbDeleteCollection({ commit }, id) {
    const uid = firebaseAuth.currentUser.uid;
    const deleteData = fstore
      .collection("sightseeingMember")
      .doc(uid)
      .collection("我的收藏")
      .doc(id);
    deleteData
      .delete()
      .then(function() {
        console.log("Document successfully deleted!");
        commit("deleteCollection", id);
      })
      .catch(function(error) {
        console.error("Error removing document: ", error);
      });
  },
  fbAddToPrefer({ commit }, id) {
    axiosInstance
      .post("http://127.0.0.1/api/preferTag", {
        site_id: id
      })
      .then(res => {
        const site_id = res.data.map(item => item.tag);
        console.log("vuex-post api取prefer:", site_id);
        const uid = firebaseAuth.currentUser.uid;
        const addToPrefer = fstore
          .collection("sightseeingMember")
          .doc(uid)
          .collection("偏好分析");
        const increment = firestore.FieldValue.increment(1);

        site_id.forEach(function(data, index) {
          addToPrefer
            .doc(data)
            .get()
            .then(function(doc) {
              if (doc.exists) {
                addToPrefer.doc(data).update({
                  time: increment
                });
              } else {
                addToPrefer.doc(data).set({
                  time: increment
                });
              }
            })
            .catch(function(error) {
              console.log("Error getting document:", error);
            });
        });
      })
      .catch(err => {
        console.log(err);
      });
  },
  setSearch({ commit }, value) {
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
      Object.keys(state.collections).forEach(function(key) {
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
    Object.keys(collectionsFiltered).forEach(function(key) {
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
