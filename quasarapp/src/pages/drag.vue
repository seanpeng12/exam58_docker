<template>
  <q-btn label="test" @click="test_axios_2_diff()"></q-btn>
</template>
<script>
import { mapActions } from "vuex";
export default {
  methods: {
    ...mapActions("demand", ["test_axios_2_diff"])
  }
};
</script>
