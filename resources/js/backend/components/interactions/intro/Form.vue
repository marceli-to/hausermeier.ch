<template>
  <div class="container">
    <notifications classes="notification"/>
    <main class="content" role="main">
      <div>
        <h1>{{title}}</h1>
        <tabs :tabs="tabs" :errors="errors"></tabs>
        <form @submit.prevent="submit">
          <div v-show="tabs.data.active">
            <div class="grid-main-sidebar">
              <div class="column-main">
                <div
                  class="form-row"
                  :class="errors.text_intro.de ? 'has-error': ''"
                  @mouseenter="removeError('text_intro', 'de')"
                >
                  <label>Intro text *</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="intro.text_intro.de"
                  ></tinymce-editor>
                  <div class="is-required">Pflichtfeld</div>
                </div>

                <div class="form-row">
                  <label>Text Spalte 1</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="intro.text_column_1.de"
                  ></tinymce-editor>
                </div>
                <div class="form-row">
                  <label>Text Spalte 2</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="intro.text_column_2.de"
                  ></tinymce-editor>
                </div>
                <div class="form-row">
                  <label>Text Spalte 3</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="intro.text_column_3.de"
                  ></tinymce-editor>
                </div>
              </div>
              <div class="column-sidebar">
                <div>
                  <div class="form-row is-sm is-last">
                    <label class="is-sm">Publizieren?</label>
                    <div class="form-radio">
                      <input
                        v-model="intro.publish"
                        type="radio"
                        name="publish_1"
                        id="publish_1"
                        value="1"
                        class="visually-hidden"
                      >
                      <label for="publish_1" class="form-control">Ja</label>
                      <input
                        v-model="intro.publish"
                        type="radio"
                        name="publish_0"
                        id="publish_0"
                        value="0"
                        class="visually-hidden"
                      >
                      <label for="publish_0" class="form-control">Nein</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-show="tabs.translation.active">
            <div class="grid-main-sidebar">
              <div class="column-main">
                <div class="form-row">
                  <label>Intro text</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="intro.text_intro.en"
                  ></tinymce-editor>
                </div>
                <div class="form-row">
                  <label>Text Spalte 1</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="intro.text_column_1.en"
                  ></tinymce-editor>
                </div>
                <div class="form-row">
                  <label>Text Spalte 2</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="intro.text_column_2.en"
                  ></tinymce-editor>
                </div>
                <div class="form-row">
                  <label>Text Spalte 3</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="intro.text_column_3.en"
                  ></tinymce-editor>
                </div>
              </div>
            </div>
          </div>

          <div v-show="tabs.images.active">
            <div class="form-row" v-if="intro.images.length == 0">
              <image-upload
                :restrictions="'jpg, png | max. 8 MB'"
                :maxFiles="99"
                :maxFilesize="8"
                :acceptedFiles="'.png,.jpg'"
              ></image-upload>
            </div>
            <div class="form-row" v-if="intro.images.length">
              <image-edit 
                :images="intro.images"
                :imagePreviewRoute="'intro'"
                :aspectRatioW="16"
                :aspectRatioH="6"
              ></image-edit>
            </div>
          </div>
          <footer class="site-footer">
            <div>
              <button type="submit" class="btn-secondary">Speichern</button>
              <router-link :to="{name: 'interaction-intro', params: { type: this.intro.type }}">Zurück</router-link>
            </div>
          </footer>
        </form>
      </div>
    </main>
  </div>
</template>
<script>
import PageHeader from "@/layout/PageHeader.vue";
import FormFooter from "@/components/global/form/Footer.vue";
import Tabs from "@/components/global/tabs/Tabs.vue";

import ImageUpload from "@/components/global/images/Upload.vue";
import ImageEdit from "@/components/global/images/Edit.vue";

// TinyMCE
import TinymceEditor from "@tinymce/tinymce-vue";
import tinyConfig from "@/config/tinyconfig.js";

// Mixins
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

// Config
import introTabs from "@/components/interactions/intro/config/tabs.js";
import introErrors from "@/components/interactions/intro/config/errors.js";

export default {
  components: {
    FormFooter,
    TinymceEditor,
    ImageUpload,
    ImageEdit,
    Tabs,
  },

  props: {
    type: String
  },

  mixins: [Utils, Progress],

  data() {
    return {

      // intro validation
      errors: introErrors,

      // intro tabs
      tabs: introTabs,

      // intro model
      intro: {
        text_intro: {
          de: null,
          en: null,
        },
        text_column_1: {
          de: null,
          en: null,
        },
        text_column_2: {
          de: null,
          en: null,
        },
        text_column_3: {
          de: null,
          en: null,
        },
        type: 'interaction',
        images: [],
        publish: 0,
      },

      // tinymce config
      tinyConfig: tinyConfig,
      tinyApiKey: 'vuaywur9klvlt3excnrd9xki1a5lj25v18b2j0d0nu5tbwro',
    };
  },

  created() {
    if (this.$props.type == "edit") {
      let uri = `/api/intro/edit/${this.$route.params.id}`;
      this.axios.get(uri).then(response => {
        this.intro = response.data;
        this.tabs.data.active = true;
      });
    }
  },

  mounted() {
    this.removeErrors();
  },

  methods: {
    // Validation methods
    validate() {
      if (this.intro.text_intro.de) {
        return true;
      }

      if (!this.intro.text_intro.de) {
        this.errors.text_intro.de = true;
        this.tabs.data.error = true;
      }

      return false;
    },

    // Submit form
    submit() {
      if (!this.validate()) {
        this.validationError();
        return;
      }

      if (this.$props.type == "edit") {
        this.update();
      }

      if (this.$props.type == "create") {
        this.store();
      }
    },

    // Store the intro
    store() {
      let uri = "/api/intro/create";
      this.axios.post(uri, this.intro).then(response => {
        this.$router.push({ name: "interaction-intro" });
        this.$notify({ type: "success", text: "Text erfasst!" });
      });
    },

    // Update the intro
    update() {
      let uri = `/api/intro/update/${this.$route.params.id}`;
      this.axios.post(uri, this.intro).then(response => {
        this.$router.push({ name: "interaction-intro" });
        this.$notify({ type: "success", text: "Änderungen gespeichert!" });
      });
    },


    // Store uploaded image
    storeImage(upload) {
      let image = {
        id: null,
        name: upload.name,
        caption: { de: null, en: null },
        coords_w: 0,
        coords_h: 0,
        coords_x: 0,
        coords_y: 0,
        publish: 1,
      }
      this.intro.images.push(image);
    },

    // Delete by name
    destroyImage(image, event) {
      if (confirm("Please confirm!")) {
        let uri = `/api/intro/image/destroy/${image}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          const index = this.intro.images.findIndex(x => x.name === image);
          this.intro.images.splice(index, 1);
          this.progress(el);
        });
      }
    },

    // Toggle status
    toggleImage(image, event) {
      if (image.id === null) {
        const index = this.intro.images.findIndex(x => x.name === image.name);
        this.intro.images[index].publish = image.publish == 1 ? 0 : 1;
      } else {
        let uri = `/api/intro/image/status/${image.id}`;
        let el = this.progress(event.target);
        this.axios.get(uri).then(response => {
          const index = this.intro.images.findIndex(x => x.id === image.id);
          this.intro.images[index].publish = response.data;
          this.progress(el);
        });
      }
    },

    // Save coords
    saveImageCoords(image) {
      if (image.id === null) {
        const index = this.intro.images.findIndex(x => x.name === image.name);
        this.intro.images[index].coords = image.coords;
      } 
      else {
        let uri = `/api/intro/image/coords/${image.id}`;
        this.axios.post(uri, image).then(response => {
          this.$notify({ type: "success", text: "Änderungen gespeichert!" });
        });
      }
    },

  },

  computed: {
    title: function() {
      return this.$props.type == "edit"
        ? "Intro Interaktion bearbeiten"
        : "Intro Interaktion hinzufügen";
    }
  }
};
</script>