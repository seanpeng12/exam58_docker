<template>
  <div class="col">
    <!-- 增加按鈕，重置 -->
    <div class="row" style="margin: 50px">
      <button class="btn btn-secondary" @click="add">Add</button>
      <button class="btn btn-secondary" @click="replace">Replace</button>
    </div>
    <div class="row">
      <draggable :list="list1" group="people" @change="log" class="list-group">
        <q-btn
          dense
          class="row"
          color="warning"
          :label="element.name"
          v-for="element in list1"
          :key="element.name"
          size="15px"
          style="margin-bottom:8px"
        />
      </draggable>
      <draggable :list="list2" class="list-group" group="people" @change="log">
        <q-btn
          dense
          class="row"
          color="primary"
          :label="element.name"
          v-for="element in list2"
          :key="element.name"
          size="25x"
          style="margin:8px"
      /></draggable>
      {{ list1 }}
      {{ list2 }}
    </div>
  </div>
</template>

<script>
import draggable from "vuedraggable";
let id = 1;
export default {
  name: "two-lists",
  display: "Two Lists",
  order: 1,

  components: {
    draggable
  },
  data() {
    return {
      list1: [
        { name: "John", id: 1 },
        { name: "Joao", id: 2 },
        { name: "Jean", id: 3 }
      ],
      list2: [
        { name: "Edgard", id: 6 },
        { name: "Johnson", id: 7 }
      ]
    };
  },
  methods: {
    add: function() {
      this.list.push({ name: "dji" });
    },
    replace: function() {
      this.list = [{ name: "" }];
    },
    clone: function(el) {
      return {
        name: el.name + " cloned"
      };
    },
    log: function(evt) {
      window.console.log(evt);
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
  background: #c8fbec;
}
</style>
