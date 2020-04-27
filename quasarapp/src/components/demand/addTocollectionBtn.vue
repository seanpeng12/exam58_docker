<template>
  <q-btn
    v-if="exists == false"
    :loading="loading2"
    color="warning"
    icon-right="add"
    dense
    label="加入收藏"
    style="margin-right:20px"
    size="10px"
    @click="
      simulateProgress(2),
        addToCollection({
          id: id,
          city_name: city_name,
          address: address,
          comment: comment,
          rate: rate,
          site_name: site_name
        }),
        addToPrefer(id)
    "
  >
    <template v-slot:loading> <q-icon name="check"></q-icon>已加入</template>
  </q-btn>
  <q-btn
    dense
    size="10px"
    style="margin-right:20px;padding:2px"
    v-else
    :disable="!progress"
    color="red-7"
    @click="progress = false"
    label="已在收藏列表"
  />
</template>
<script>
import { mapActions } from "vuex";
export default {
  props: [
    "id",
    "city_name",
    "comment",
    "address",
    "comment",
    "rate",
    "site_name",
    "exists"
  ],
  data() {
    return {
      loading2: false,
      progress: false
    };
  },
  methods: {
    ...mapActions("collections", ["fbAddtoCollection", "fbAddToPrefer"]),
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
    },
    addToPrefer(id) {
      this.fbAddToPrefer(id);
      console.log(id);
    }
  }
};
</script>
