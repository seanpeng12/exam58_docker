import Vue from "vue";
import Vuex from "vuex";

import auth from "./store-auth.js";
import schedules from "./store-tasks.js";
import travel from "./store-firebase";
Vue.use(Vuex);

/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Store instance.
 */

export default function(/* { ssrContext } */) {
  const Store = new Vuex.Store({
    modules: {
      auth,
      schedules,
      travel
    },

    // enable strict mode (adds overhead!)
    // for dev mode only
    strict: process.env.DEV
  });

  return Store;
}
// export const strict = false;
