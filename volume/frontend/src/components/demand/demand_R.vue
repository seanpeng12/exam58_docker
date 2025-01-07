<template>
  <!-- iframe col div -->
  <div class="gt-xs col">
    <q-page>
      <iframe
        style="height:606px;width:100%;"
        frameborder="0"
        id="myFrame"
        :src="src"
        class="frameStyle"
        ref="404 not found!"
      ></iframe>
    </q-page>
    <!--  -->
  </div>
  <!-- iframe end -->
</template>

<script>
export default {
  props: ["src", "runR_value"],
  data() {
    return {};
  },
  watch: {
    runR_value(val) {
      console.log(val);
    }
  }
};
</script>
