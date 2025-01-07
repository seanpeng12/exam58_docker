<template>
  <q-card-section class="q-pt-none">
    <q-input
      outlined
      :value="name"
      @input="$emit('update:name', $event)"
      ref="name"
      label="Schedule title"
      :rules="[(val) => !!val || 'Field is required']"
    />
  </q-card-section>
</template>
<script>
export default {
  props: ["name"],
  data() {
    return {};
  },
};
</script>
