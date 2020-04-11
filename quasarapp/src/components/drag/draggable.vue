<template>
  <div class="row">
    <!-- 增加按鈕，重置 -->
    <!-- <div class="row" style="margin: 50px">
      <button class="btn btn-secondary" @click="add">Add</button>
      <button class="btn btn-secondary" @click="replace">Replace</button>
    </div> -->
    <div class="col-2">
      <draggable
        :list="list"
        :disabled="!enabled"
        class="list-group"
        ghost-class="ghost"
        :move="checkMove"
        @start="dragging = true"
        @end="dragging = false"
      >
        <q-btn
          color="black"
          v-for="element in list"
          :key="element.name"
          :label="element.name"
          style="margin: 4px"
          unelevated
        />
      </draggable>
    </div>
  </div>
</template>

<script>
import draggable from "vuedraggable";
let id = 1;
export default {
  name: "simple",
  display: "Simple",
  order: 0,
  components: {
    draggable
  },
  data() {
    return {
      // enabled: true,
      // list: [
      //   { name: "John", id: 0 },
      //   { name: "Joao", id: 1 },
      //   { name: "Jean", id: 2 }
      // ],
      dragging: false
    };
  },
  computed: {
    draggingInfo() {
      return this.dragging ? "under drag" : "";
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
  }
};
</script>
<style scoped>
.buttons {
  margin-top: 35px;
}
.ghost {
  opacity: 0.5;
  background: #c8ebfb;
}
</style>
