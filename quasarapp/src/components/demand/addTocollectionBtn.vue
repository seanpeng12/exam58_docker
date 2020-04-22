<template>
  <q-btn
    :loading="loading2"
    color="warning"
    icon-right="add"
    dense
    label="加入收藏"
    style="margin-right:20px"
    size="10px"
    @click="simulateProgress(2),addToCollection({id:id,city_name:city_name})"
  >
    <template v-slot:loading>
      <q-icon name="check"></q-icon>已加入
    </template>
  </q-btn>
</template>
<script>
import { mapActions } from "vuex";
export default {
  props: ["id", "city_name"],
  data() {
    return {
      loading2: false
    };
  },
  methods: {
    ...mapActions("collections", ["fbAddtoCollection"]),
    simulateProgress(number) {
      // we set loading state
      this[`loading${number}`] = true;
      // simulate a delay
      // setTimeout(() => {
      //   // we're done, we reset loading state
      //   this[`loading${number}`] = false;
      // }, 300);
    },
    addToCollection(value) {
      console.log(value);

      this.fbAddtoCollection(value);
    }
  }
};
</script>
