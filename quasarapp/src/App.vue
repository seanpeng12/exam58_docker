<template>
  <div id="q-app">
    <router-view />
  </div>
</template>

<script>
export default {
  props: ["text"],
  name: "App"
};
</script>
