<template>
  <div>
    <div class="col-6">
      <p class="weekday">{{ date }}</p>
      <draggable
        v-model="siteGroup"
        :disabled="!enabled"
        class="list-group "
        ghost-class="ghost"
        :move="checkMove"
        @start="dragging = true"
        @end="(dragging = false), storeEverydaySites()"
        group="site"
        :options="{ group: { pull: true, put: true }, animation: 20 }"
      >
        <q-btn
          color="black"
          v-for="(site, key) in siteGroup"
          :key="key"
          :label="site"
          style="margin-bottom: 3px; margin-left:4px; margin-top:3px"
          unelevated
        />
      </draggable>
    </div>
  </div>
</template>
<script>
import draggable from "vuedraggable";
import { mapGetters, mapActions } from "vuex";

export default {
  props: ["date", "dateKey", "index", "id"],
  data() {
    return {
      enabled: true
    };
  },
  components: {
    draggable
  },
  computed: {
    ...mapGetters("travel", ["everydaySites"]),
    siteGroup: {
      get() {
        var date = this.date;
        // console.log("everydaySite", this.everydaySites[date]);
        return this.everydaySites[date].site;
      },
      set(value) {
        // 修改state
        this.$store.commit("travel/setDragGroup", {
          value,
          key: this.date
        });
        // 存進資料庫
        this.$store.dispatch("travel/fbUpdateEverySiteData", {
          value,
          key: this.date,
          id: this.id
        });
        // console.log("value:", value, " key: ", this.date);
      }
    }
  },
  methods: {
    add: function() {
      this.list.push({ name: "Juan " + id, id: id++ });
    },
    replace: function() {
      this.list = [{ name: "Edgard", id: id++ }];
    },
    checkMove: function(e) {
      // window.console.log("Future index: " + e.draggedContext.futureIndex);
    },
    ...mapActions("travel", ["storeEverydaySites"])
  }
};
</script>
