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
        @end="dragging = false"
        group="site"
      >
        <q-btn
          color="black"
          v-for="(s, key) in siteGroup"
          :key="key"
          :label="s"
          style="margin: 4px"
          unelevated
        />
      </draggable>
    </div>
  </div>
</template>
<script>
import draggable from "vuedraggable";

export default {
  props: ["date", "dateKey", "site", "everydaySite"],
  data() {
    return {
      enabled: true,
      i: this.key
    };
  },
  components: {
    draggable
  },
  computed: {
    siteGroup: {
      get() {
        var dateKey = this.dateKey;
        console.log("get everydaySite", this.everydaySite.site[0]);

        return this.everydaySite.site;
      },
      set(value) {
        console.log("computed setter");
        this.$store.commit("travel/setDragGroup", {
          value,
          key: this.dateKey
        });
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
      window.console.log("Future index: " + e.draggedContext.futureIndex);
    }
    // ...mapActions("travel", ["updateDragSite"])
  }
};
</script>
