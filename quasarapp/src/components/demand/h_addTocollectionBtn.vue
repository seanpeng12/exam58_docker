<template>
  <q-btn
    v-if="txtdata.exists == false"
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
        })
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
  <!-- <q-btn
    dense
    size="10px"
    style="margin-right:20px;padding:2px"
    v-else
    :disable="!progress"
    color="red-7"
    @click="progress = false"
    label="未登入"
  /> -->
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  props: [
    "id",
    "city_name",
    "comment",
    "address",
    "comment",
    "rate",
    "site_name",
    "exists",
    "txtdata"
  ],
  data() {
    return {
      loading2: false,
      progress: false
    };
  },
  methods: {
    ...mapActions("collections", ["h_fbAddtoCollection"]),
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
      this.h_fbAddtoCollection(value);
    }
  },
  computed: {
    ...mapGetters("auth", ["loggedIn"])
  }
};
</script>
