<template>
  <q-card inline>
    <q-card-media>
      <img :src="src.go"/>
    </q-card-media>

    <q-card-title>
      <span>{{ post.name }}</span>
      <div slot="subtitle" class="q-mt-sm">
        <span class="q-mr-sm">{{ post.rate }}則評價</span>
        <span>{{ post.rate }}人瀏覽</span>
      </div>
    </q-card-title>

    <q-card-main>
      <l-icon :icon="'fas fa-map-marker-alt'" :text="locate" :color="'grey'" class="q-mr-md"/>
    </q-card-main>
  </q-card>
</template>

<script>
export default {
  props:["post","src"],

}
</script>
