const state = {
  name: "PageIndex",
  slide: "style",
  expend: false,
  funcs: [
    {
      name: "需求功能",
      tip: "給拿不定主意的你",
      illustrate:
        "使用者可透過在系統介面上勾選「需求類別」找到符合需求類別的景點。 此分析方法先藉由景點的屬性 (site_attr) 做分組，再利用SNA中的中介點中心度（betweenness centrality）找出符合使用者選取屬性的資料。 在本系統中，使用者可以選取兩種屬性，經過分析後即 會出現與此兩種屬性相符程度最高的景點。"
    },
    {
      name: "景點優缺點分析功能",
      tip: "不想踩雷的你",
      illustrate:
        "使用者可透過在系統介面上勾選「需求類別」找到符合需求類別的景點。 此分析方法先藉由景點的屬性 (site_attr) 做分組，再利用SNA中的中介點中心度（betweenness centrality）找出符合使用者選取屬性的資料。 在本系統中，使用者可以選取兩種屬性，經過分析後即 會出現與此兩種屬性相符程度最高的景點。"
    }
  ],
  watch: {
    vertical(val) {
      this.navPos = val === true ? "right" : "bottom";
    }
  }
};
const mutations = {};
const actions = {};
const getters = {
  funcs: state => {
    return state.funcs;
  }
};
export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
};
