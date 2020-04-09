<template>
  <div>
    <q-btn @click="fbReadData" color="secondary" label="Secondary" />

    <!-- <q-btn @click="updateTask({ id: id })" color="warning" label="Secondary" /> -->
    <div
      v-for="(sightseeingMember, key) in sightseeingMembers"
      :key="key"
      :id="key"
    >
      <p>{{ sightseeingMember.title }}</p>
    </div>
  </div>
</template>
<script>
import { fstore, firebaseAuth } from "boot/firebase";
import { mapActions } from "vuex";
import { mapGetters } from "vuex";
export default {
  name: "HelloWorld",
  data() {
    return {};
  },

  methods: {
    ...mapActions("travel", ["updateSchedule"]),
    ...mapActions("travel", ["fbReadData"])
  },
  computed: {
    ...mapGetters("travel", ["sightseeingMembers"])
  }
};
</script>
