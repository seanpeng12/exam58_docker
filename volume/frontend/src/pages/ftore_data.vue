<template>
  <div>
    <q-btn @click="fbReadData" color="secondary" label="Secondary" />
    <q-btn @click="fbEverySiteData" color="warning" label="fbEverySiteData" />

    <!-- <q-btn @click="updateTask({ id: id })" color="warning" label="Secondary" /> -->
    <!-- <div
      v-for="(sightseeingMember, key) in sightseeingMembers"
      :key="key"
      :id="key"
    >
      <p>{{ sightseeingMember.title }}@@{{ key }}</p>
      <p>{{ sightseeingMember.date }}</p>
    </div> -->
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
    ...mapActions("travel", ["updateSchedule", "fbReadData", "fbEverySiteData"])
    // ...mapActions("schedules", ["addSchedule"])
  },
  computed: {
    ...mapGetters("travel", ["sightseeingMembers"])
    // ...mapGetters("schedules", ["sightseeingMembers"])
  }
};
</script>
