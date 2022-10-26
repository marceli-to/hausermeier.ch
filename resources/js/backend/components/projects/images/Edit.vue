<template>
  <div>
    <div class="upload-listing">
      <a href="" class="icon-view" @click.prevent="toggleView()">
        <span v-if="view == 'grid'">Grid Ansicht</span>
        <span v-if="view == 'list'">Listen Ansicht</span>
      </a>
      <div class="list" v-if="view == 'list'">
        <template>
          <draggable 
            :disabled="false"
            v-model="imageData" 
            @end="order"
            ghost-class="draggable-ghost"
            draggable=".is-draggable">
            <div class="upload-item-row is-draggable" v-for="(image) in imageData" :key="image.id">
              <figure>
                <img :src="getSource(image.name, 'thumbnail')" height="300" width="300">
              </figure>
              <div>
                <span class="icon-move"></span>
              </div>
            </div>
          </draggable>
        </template>
      </div>
      <div v-if="view == 'grid'">
        <template>
          <figure
            :class="[image.publish == 0 ? 'is-disabled' : '', 'upload-item']"
            v-for="image in images"
            :key="image.id"
          >
            <a :href="getSource(image.name, imagePreviewRoute)" target="_blank" class="upload__preview">
              <img :src="getSource(image.name, 'thumbnail')" height="300" width="300">
              <span v-if="image.is_preview_works == 1" class="image-label">Vorschau Werkliste</span>
            </a>
            <div class="upload__actions">
              <image-actions :image="image" :publish="image.publish" :grid="image.is_grid" :imagePreviewRoute="imagePreviewRoute"></image-actions>
            </div>
          </figure>        
        </template>
      </div>
    </div>
    <div :class="[hasOverlayEdit ? 'is-visible' : '', 'upload-overlay-edit']">
      <div>
        <a
          href="javascript:;"
          class="icon-close-overlay"
          @click.prevent="hideEdit()"
        ></a>
        <div>
          <figure v-if="hasOverlayEdit">
            <img :src="getSource(overlayItem.name, 'large')" height="300" width="300">
            <figcaption v-if="overlayItem.caption.de || overlayItem.caption.en">
              <span v-if="overlayItem.caption.de">{{overlayItem.caption.de}}</span>
              <span v-if="overlayItem.caption.en">{{overlayItem.caption.en}}</span>
            </figcaption>
          </figure>
        </div>
        <div>
          <div class="form-row">
            <form-text 
              v-model="overlayItem.caption.de"
              :label="'Bildlegende'"
            ></form-text>
          </div>
          <div class="form-row">
            <form-text 
              v-model="overlayItem.caption.en"
              :label="'Bildlegende (en)'"
            ></form-text>
          </div>
          <div class="form-row">
            <label class="is-sm">Vorschaubild Werkliste?</label>
            <div class="form-radio">
              <input
                v-model="overlayItem.is_preview_works"
                type="radio"
                name="is_preview_works"
                id="is_preview_works_1"
                value="1"
                class="visually-hidden"
              >
              <label for="is_preview_works_1" class="form-control">Ja</label>
              <input
                v-model="overlayItem.is_preview_works"
                type="radio"
                name="is_preview_works"
                id="is_preview_works_0"
                value="0"
                class="visually-hidden"
              >
              <label for="is_preview_works_0" class="form-control">Nein</label>
            </div>
          </div>
          <div class="form-row">
            <label class="is-sm">Lightbox?</label>
            <div class="form-radio">
              <input
                v-model="overlayItem.is_lightbox"
                type="radio"
                name="is_lightbox"
                id="is_lightbox_1"
                value="1"
                class="visually-hidden"
              >
              <label for="is_lightbox_1" class="form-control">Ja</label>
              <input
                v-model="overlayItem.is_lightbox"
                type="radio"
                name="is_lightbox"
                id="is_lightbox_0"
                value="0"
                class="visually-hidden"
              >
              <label for="is_lightbox_0" class="form-control">Nein</label>
            </div>
          </div>
          <div class="form-row">
            <label class="is-sm">Plan?</label>
            <div class="form-radio">
              <input
                v-model="overlayItem.is_plan"
                type="radio"
                name="is_plan"
                id="is_plan_1"
                value="1"
                class="visually-hidden"
              >
              <label for="is_plan_1" class="form-control">Ja</label>
              <input
                v-model="overlayItem.is_plan"
                type="radio"
                name="is_plan"
                id="is_plan_0"
                value="0"
                class="visually-hidden"
              >
              <label for="is_plan_0" class="form-control">Nein</label>
            </div>
          </div>
          <div class="form-row-button">
            <a
              href="javascript:;"
              class="btn-secondary"
              @click.prevent="hideEdit()"
            >Schliessen</a>
          </div>
        </div>
      </div>
    </div>
    <div :class="[hasOverlayCropper ? 'is-visible' : '', 'upload-overlay-cropper']">
      <div class="loader" v-if="isLoading">Bild wird geladen...</div>
      <div :class="'is-' + overlayItem.orientation" v-if="!isLoading">
        <a
          href="javascript:;"
          class="icon-close-overlay"
          @click.prevent="hideCropper()"
        ></a>
        <div>
          <div class="cropper-formats">
            <div>
              <a href="javascript:;" @click.prevent="changeRatio(16,22.72)" class="btn-cropper-format is-3-4">Hoch</a>
            </div>
            <div>
              <a href="javascript:;" @click.prevent="changeRatio(16,11.173)" class="btn-cropper-format is-4-3">Quer</a>
            </div>
            <div>
              <a href="javascript:;" @click.prevent="changeRatio(16,7.4)" class="btn-cropper-format is-16-9">Wide</a>
            </div>
            <div>
              <a href="javascript:;" @click.prevent="changeRatio(3,2)" class="btn-cropper-format is-works">Werkliste</a>
            </div>
          </div>
          <div class="cropper-info">{{ cropW }} x {{ cropH }}px</div>
          <cropper
            :src="cropImage"
            :defaultPosition="defaultPosition"
            :defaultSize="defaultSize"
            :stencilProps="{
              aspectRatio: this.ratio.w/this.ratio.h,
              linesClassnames: {
                default: 'line',
              },
              handlersClassnames: {
                default: 'handler'
              }
            }"
            @change="change"
          ></cropper>
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

// Global mixins
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

// Image components
import ImageActions from "@/components/global/images/Actions.vue";
import draggable from 'vuedraggable';

// Image mixins
import ImageEdit from "@/components/global/images/mixins/edit";
import ImageCrop from "@/components/global/images/mixins/crop";

// Form elements
import FormText from "@/components/global/input/Text.vue"

// Cropper
import { Cropper } from "vue-advanced-cropper";

export default {
  components: {
    ImageActions,
    FormText,
    Cropper,
    draggable,
  },

  props: {
    images: Array,

    imagePreviewRoute: {
      type: String,
      default: "large"
    },
  },

  mixins: [Utils, Progress, ImageCrop, ImageEdit],

  data() {
    return {

      imageData: null,

      overlayItem: {
        name: '',
        caption: { de: null, en: null },
        is_preview_works: 0,
        is_lightbox: 1,
        is_plan: 0,
        is_grid: 0,
        orientation: null,
      },

      defaults: {
        item: {
          name: '',
          caption: { de: null, en: null},
          is_preview_works: 0,
          is_lightbox: 1,
          is_plan: 0,
          is_grid: 0,
          orientation: null,
        }
      },
      
      view: 'grid',
      
      isLoading: false,

      ratio: {
        w: null,
        h: null,
      },
    };
  },

  mounted() {
    this.imageData = this.$props.images;
  },

  methods: {
    changeRatio(w,h) {
      this.ratio.w = w;
      this.ratio.h = h;
      this.resetCropper();
    },

    resetCropper() {
      let image = this.overlayItem;
      this.hideCropper();
      this.showCropper(image, true)
    },

    showCropper(image, reset = false) {
      if (!reset) {

        if (image.coords_w > 0 && image.coords_h > 0) {
          let ratioW = 16;
          let ratioH = (16/image.coords_w) * image.coords_h;
          this.ratio.w = ratioW;
          this.ratio.h = ratioH;
        }
        else {
          if (image.orientation == 'l') {
            this.ratio.w = 16;
            this.ratio.h = 11.173;
          }
          else if (image.orientation == 'p') {
            this.ratio.w = 16;
            this.ratio.h = 22.72;
          }
        }
      }

      this.isLoading = true;
      this.hasOverlayCropper = true;
      this.overlayItem = image;
      this.axios.get(this.getSource(image.name, "original")).then(response => {
        this.cropImage = response.config.url;
        this.isLoading = false;
      });
    },

    order() {
      let images = this.imageData.map(function(image, index) {
        image.order = index;
        return image;
      });
      if (this.debounce) return;
      this.debounce = setTimeout(function(images) {
        this.debounce = false 
        let uri = `/api/project/image/order`;
        this.axios.post(uri, {images: images}).then((response) => {
          this.$notify({type: 'success', text: 'Reihenfolge angepasst'});
        });
      }.bind(this, images), 1000);
    },

    toggleView() {
      this.view = this.view == 'grid' ? 'list' : 'grid';
    }
  }
};
</script>