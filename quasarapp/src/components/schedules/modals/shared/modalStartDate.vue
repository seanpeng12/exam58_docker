<template>
  <q-input
    class="q-px-md"
    outlined
    :value="startDate"
    label="輸入起始天"
    @input="$emit('update:startDate', $event)"
  >
    <template v-slot:append>
      <q-icon name="event" class="cursor-pointer">
        <q-popup-proxy
          ref="qDateProxy"
          transition-show="scale"
          transition-hide="scale"
        >
          <q-date
            :value="startDate"
            @input="$emit('update:startDate', $event), $refs.qDateProxy.hide()"
          />
        </q-popup-proxy>
      </q-icon>
    </template>
  </q-input>
</template>
<script>
export default {
  props: ["startDate"],
};
</script>
