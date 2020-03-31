<template>
  <q-page padding>
    <search />
    <q-card>
      <q-tabs
        v-model="tab"
        dense
        class="text-grey"
        active-color="primary"
        indicator-color="primary"
        align="justify"
        narrow-indicator
      >
        <q-tab name="mails" label="Step1 " icon:label_important />
        <q-icon name="label_important" style="font-size: 32px;" />
        <q-tab name="alarms" label="Step2" />
        <q-icon name="label_important" style="font-size: 32px;" />
        <q-tab name="movies" label="優缺點分析" />
        <q-icon name="label_important" style="font-size: 32px;" />
        <q-tab name="movies" label="Google自動行程安排" />
      </q-tabs>

      <q-separator />
      <q-tab-panels v-model="tab" animated>
        <q-tab-panel name="mails">
          <div class="text-h6">選擇起點</div>
          <div>透過需求分析</div>
          <div>自行搜尋</div>
        </q-tab-panel>

        <q-tab-panel name="alarms">
          <div class="text-h6">Alarms</div>
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </q-tab-panel>

        <q-tab-panel name="movies">
          <div class="text-h6">Movies</div>
          Lorem ipsum dolor sit amet consectetur adipisicing elit.
        </q-tab-panel>
      </q-tab-panels>
    </q-card>
  </q-page>
</template>
<script>
// import task from "components/task.vue";
export default {
  data() {
    return {
      tab: "mails"
    };
  },
  components: {
    search: () => import("components/search.vue")
  }
};
</script>
