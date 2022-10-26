<template>
  <div>
    <div class="upload-listing">
      <div>
        <figure
          :class="[image.publish == 0 ? 'is-disabled' : '', 'upload-item']"
          v-for="image in images"
          :key="image.id"
        >
          <a
            :href="getSource(image.name, imagePreviewRoute)"
            target="_blank"
            class="upload__preview"
          >
            <img :src="getSource(image.name, 'thumbnail')" height="300" width="300">
            <span v-if="image.category" class="image-label">{{getLabel(categories, image.category)}}</span>
          </a>
          <div class="upload__actions">
            <image-actions
              :image="image"
              :publish="image.publish"
              :imagePreviewRoute="imagePreviewRoute"
              :aspectRatioW="aspectRatioW"
              :aspectRatioH="aspectRatioH"
            ></image-actions>
          </div>
        </figure>
      </div>
    </div>
    <div :class="[hasOverlayEdit ? 'is-visible' : '', 'upload-overlay-edit']">
      <div>
        <a href="javascript:;" class="icon-close-overlay" @click.prevent="hideEdit()"></a>
        <div>
          <figure v-if="hasOverlayEdit">
            <img :src="getSource(overlayItem.name, imagePreviewRoute)" height="300" width="300">
            <figcaption v-if="overlayItem.caption.de || overlayItem.caption.en">
              <span v-if="overlayItem.caption.de">{{overlayItem.caption.de}}</span>
              <span v-if="overlayItem.caption.en">{{overlayItem.caption.en}}</span>
            </figcaption>
          </figure>
        </div>
        <div>
          <div class="form-row">
            <form-text v-model="overlayItem.caption.de" :label="'Bildlegende'"></form-text>
          </div>
          <div class="form-row">
            <form-text v-model="overlayItem.caption.en" :label="'Bildlegende (en)'"></form-text>
          </div>
          <div class="form-row" v-if="categories">
            <label>Kategorie</label>
            <div class="select-wrapper">
              <select v-model="overlayItem.category" name="category">
                <option v-for="(c,i) in categories" :key="i" :value="i">{{ c }}</option>
              </select>
            </div>
          </div>
          <div class="form-row-button" v-if="updateOnChange">
            <a
              href="javascript:;"
              class="btn-secondary"
              @click.prevent="update(overlayItem, $event)"
            >Speichern</a>
          </div>
          <div class="form-row-button" v-else>
            <a href="javascript:;" class="btn-secondary" @click.prevent="hideEdit()">Schliessen</a>
          </div>
        </div>
      </div>
    </div>
    <div :class="[hasOverlayCropper ? 'is-visible' : '', 'upload-overlay-cropper']">
      <div class="loader" v-if="isLoading">Bild wird geladen...</div>
      <div v-if="!isLoading">
        <a href="javascript:;" class="icon-close-overlay" @click.prevent="hideCropper()"></a>
        <div>
          <div class="cropper-info">{{ cropW }} x {{ cropH }}px</div>
          <div style="padding-top: 50px">
            <cropper
              :src="cropImage"
              :defaultPosition="defaultPosition"
              :defaultSize="defaultSize"
              :stencilProps="{
                aspectRatio: this.$props.aspectRatioW/this.$props.aspectRatioH,
                linesClassnames: {
                  default: 'line',
                },
                handlersClassnames: {
                  default: 'handler'
                }
              }"
              @change="change"
            ></cropper>
          </div>
          <div class="form-buttons">
            <a
              href="javascript:;"
              class="btn-secondary"
              @click.prevent="saveCoords(overlayItem)"
            >Speichern</a>
            <a href @click.prevent="hideCropper()">Abbrechen</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
// Image components
import ImageActions from "@/components/global/images/Actions.vue";

// Image mixins
import ImageEdit from "@/components/global/images/mixins/edit";
import ImageCrop from "@/components/global/images/mixins/crop";

// Form element
import FormText from "@/components/global/input/Text.vue";

// Global mixins
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

// Cropper
import { Cropper } from "vue-advanced-cropper";

export default {
  components: {
    ImageActions,
    FormText,
    Cropper
  },

  props: {
    images: Array,

    updateOnChange: {
      type: Boolean,
      default: false
    },

    categories: {
      type: Object,
      default: null
    },

    imagePreviewRoute: {
      type: String,
      default: "large"
    },

    aspectRatioW: {
      type: Number,
      default: 16
    },

    aspectRatioH: {
      type: Number,
      default: 10
    }
  },

  mixins: [Utils, Progress, ImageEdit, ImageCrop]
};
</script>