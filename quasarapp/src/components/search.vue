<template>
  <q-input bottom-slots v-model="text" label="search">
    <template v-slot:before>
      <q-icon name="flight_takeoff" />
    </template>

    <template v-slot:append>
      <q-icon
        v-if="text !== ''"
        name="close"
        @click="text = ''"
        class="cursor-pointer"
      />
      <q-icon name="search" />
    </template> </q-input
></template>

<script>
export default {};
</script>
