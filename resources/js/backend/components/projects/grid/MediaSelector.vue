<template>
  <div>
    <h1>Projektbild auswählen</h1>
    <div class="grid-image-selector">
      <div class="grid-image-selector__item">
        <div class="grid-image-selector__media">
          <figure v-for="image in images" :key="image.id">
            <a href @click.prevent="storeMedia(image.id)">
              <img :src="getSource(image.name, 'project-tiny')" height="120" width="70">
              <span>{{image.name}}</span>
            </a>
          </figure>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Utils from "@/mixins/utils";

export default {
  
  data() {
    return {

    };
  },

  props: {
    images: Array
  },

  mixins: [Utils],

  methods: {
    storeMedia(imageId) {
      this.$parent.storeMedia(imageId);
    },
  },

};
</script>