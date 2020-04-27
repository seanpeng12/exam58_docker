<template>
  <q-card class="my-card" style="margin-right: 8px; width:220px">
    <q-img src="https://cdn.quasar.dev/img/chicken-salad.jpg" />

    <q-card-section>
      <div class="row no-wrap items-center">
        <div class="col text-h7 ellipsis">
          {{ collection.site_name }}
        </div>
      </div>

      <div class="row text-caption text-grey">
        <div class="col" style="margin-top:10px;">
          <q-icon name="star" color="orange" size="20px" />
          <span style=" color:orange; font-size:14px;margin-left:5px;">{{
            collection.rate
          }}</span>
          <span class="q-ml-md">{{ collection.comment }}則評價</span>
          <q-btn
            label="詳細地址"
            color="secondary"
            @click="open('top')"
            dense
            outlined
            size="10px"
            style="margin-left:8px"
          />
        </div>
        <!-- dialog -->
        <q-dialog v-model="dialog" :position="position">
          <q-card style="width: 350px">
            <q-linear-progress :value="16" color="blue-2" />

            <q-card-section class="row items-center no-wrap">
              <div>
                <div class="text-weight-bold">
                  <q-icon name="place" color="orange-5" size="20px" />

                  地址: {{ collection.address }}
                </div>
              </div>

              <q-space />
            </q-card-section>
            <q-linear-progress :value="1" color="blue-2" />
          </q-card>
        </q-dialog>
      </div>
    </q-card-section>

    <q-card-section class="q-pt-none">
      <div
        class="col-auto text-secondary text-caption q-pt-md row no-wrap items-center"
      >
        <q-icon name="place" />

        台灣，{{ collection.city }}
        <slot name="addToSchedule"></slot>
        <slot name="deleteCollection"></slot>
      </div>
    </q-card-section>

    <q-separator />
  </q-card>
  <!-- 選擇加入哪天 -->

  <!-- </div> -->
</template>
<script>
export default {
  props: ["collection", "index"],
  data() {
    return {
      stars: 3.5,
      dialog: false,
      position: "top"
    };
  },
  methods: {
    open(position) {
      this.position = position;
      this.dialog = true;
    }
  }
};
</script>
