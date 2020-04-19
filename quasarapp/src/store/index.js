import Vue from "vue";
import Vuex from "vuex";

// firebase(possess)
import auth from "./store-auth.js";
import schedules from "./store-tasks.js";
import collections from "./store-collection.js";

// mysql(sean)
import sitedata from "./store-sitedata.js";
// 需求(sean)
import demand from "./store-demand.js";

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
      sitedata,
      demand,
      travel,
      collections
    },

    // enable strict mode (adds overhead!)
    // for dev mode only
    strict: process.env.DEV
    // strict: process.env.NODE_ENV !== "production"
  });

  return Store;
}
// export const strict = false;
