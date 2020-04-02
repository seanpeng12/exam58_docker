import Vue from "Vue";
import Vuex from "Vuex";
import state from "../state";
import * as getters from "./getters";
import * as mutations from "./mutations";
import * as actions from "./actions";
import auth from "./store-auth";

export default function() {
  const Store = Vue.Store({
    modules: { auth }
  });
  // namespaced: true,
  // getters,
  // mutations,
  // actions,
  // state
}
