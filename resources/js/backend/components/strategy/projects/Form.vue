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
                <div class="form-row" :class="errors.category.de ? 'has-error': ''">
                  <label>Rubrik *</label>
                  <input
                    type="text"
                    @focus="removeError('category', 'de')"
                    v-model="strategy.category.de"
                  >
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row" :class="errors.title.de ? 'has-error': ''">
                  <label>Titel *</label>
                  <input
                    type="text"
                    @focus="removeError('title', 'de')"
                    v-model="strategy.title.de"
                  >
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row">
                  <label>Jahr</label>
                  <input type="text" v-model="strategy.year">
                </div>
                <div
                  class="form-row"
                  :class="errors.description.de ? 'has-error': ''"
                  @mouseenter="removeError('description', 'de')"
                >
                  <label>Beschreibung *</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="strategy.description.de"
                  ></tinymce-editor>
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row">
                  <label>Info</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="strategy.info.de"
                  ></tinymce-editor>
                </div>
                <div class="form-row">
                  <label>Info Werkliste 2</label>
                  <input type="text" v-model="strategy.info_works_1.de">
                </div>
                <div class="form-row is-last">
                  <label>Info Werkliste 3</label>
                  <input type="text" v-model="strategy.info_works_2.de">
                </div>
              </div>
              <div class="column-sidebar">
                <div>
                  <div class="form-row is-sm">
                    <label>Projekt</label>
                    <div class="select-wrapper is-sidebar">
                      <select v-model="strategy.project_id" name="project_id">
                        <option v-for="p in projects" :key="p.id" :value="p.id">{{ p.name.de }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row is-sm is-last">
                    <label class="is-sm">Publizieren?</label>
                    <div class="form-radio">
                      <input
                        v-model="strategy.publish"
                        type="radio"
                        name="publish_1"
                        id="publish_1"
                        value="1"
                        class="visually-hidden"
                      >
                      <label for="publish_1" class="form-control">Ja</label>
                      <input
                        v-model="strategy.publish"
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
                  <label>Rubrik</label>
                  <input type="text" v-model="strategy.category.en">
                </div>
                <div class="form-row">
                  <label>Titel</label>
                  <input type="text" v-model="strategy.title.en">
                </div>
                <div class="form-row">
                  <label>Beschreibung</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="strategy.description.en"
                  ></tinymce-editor>
                </div>
                <div class="form-row is-last">
                  <label>Info</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="strategy.info.en"
                  ></tinymce-editor>
                </div>
              </div>
            </div>
          </div>
          <div v-show="tabs.images.active">
            <div class="form-row">
              <image-upload
                :restrictions="'jpg, png | max. 8 MB'"
                :maxFiles="99"
                :maxFilesize="8"
                :acceptedFiles="'.png,.jpg'"
              ></image-upload>
            </div>
            <div class="form-row" v-if="strategy.images.length">
              <image-listing 
                :images="strategy.images"
                :imagePreviewRoute="'strategy-project'"
              ></image-listing>
            </div>
          </div>
          <form-footer :route="'strategy-projects'"></form-footer>
        </form>
      </div>
    </main>
  </div>
</template>
<script>
// Layout
import PageHeader from "@/layout/PageHeader.vue";

// Form elements
import FormFooter from "@/components/global/form/Footer.vue";

// Tabs
import Tabs from "@/components/global/tabs/Tabs.vue";

// Upload
import ImageUpload from "@/components/global/images/Upload.vue";
import ImageListing from "@/components/strategy/projects/images/Edit.vue";

// TinyMCE
import tinyConfig from "@/config/tinyconfig.js";
import TinymceEditor from "@tinymce/tinymce-vue";

// Mixins
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

// Config
import strategyTabs from "@/components/strategy/projects/config/tabs.js";
import strategyErrors from "@/components/strategy/projects/config/errors.js";

export default {
  components: {
    FormFooter,
    TinymceEditor,
    ImageUpload,
    ImageListing,
    Tabs
  },

  props: {
    type: String
  },

  mixins: [Utils, Progress],

  data() {
    return {

      // strategy validation
      errors: strategyErrors,

      // strategy tabs
      tabs: strategyTabs,

      // strategy model
      strategy: {
        category: {
          de: null,
          en: null,
        },
        title: {
          de: null,
          en: null,
        },
        description: {
          de: null,
          en: null
        },
        info: {
          de: null,
          en: null
        },
        info_works_1: {
          de: null,
          en: null,
        },
        info_works_2: {
          de: null,
          en: null,
        },
        year: null,
        project_id: null,
        images: [],
        publish: 0,
      },

      // settings
      projects: [],

      // TinyMCE
      tinyConfig: tinyConfig,
      tinyApiKey: 'vuaywur9klvlt3excnrd9xki1a5lj25v18b2j0d0nu5tbwro',
    };
  },

  created() {
    if (this.$props.type == "edit") {
      let uri = `/api/strategy/project/edit/${this.$route.params.id}`;
      this.axios.get(uri).then(response => {
        this.strategy = response.data;
        this.tabs.data.active = true;
      });
    }

    this.axios.get(`/api/projects/get`).then(response => {
      this.projects = response.data.data;
    });
  },

  mounted() {
    this.removeErrors();
  },

  methods: {
    // Validation methods
    validate() {
      if (
        this.strategy.category.de &&
        this.strategy.title.de &&
        this.strategy.description.de &&
        this.strategy.images.length > 0
      ) {
        return true;
      }

      if (!this.strategy.category.de) {
        this.errors.category.de = true;
        this.tabs.data.error = true;
      }

      if (!this.strategy.title.de) {
        this.errors.title.de = true;
        this.tabs.data.error = true;
      }

      if (!this.strategy.description.de) {
        this.errors.description.de = true;
        this.tabs.data.error = true;
      }

      if (this.strategy.images.length == 0) {
        this.tabs.images.error = true;
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

    // Store the project
    store() {
      let uri = "/api/strategy/project/create";
      this.axios.post(uri, this.strategy).then(response => {
        this.$router.push({ name: "strategy-projects" });
        this.$notify({ type: "success", text: "Diskurs erfasst!" });
      });
    },

    // Update the project
    update() {
      let uri = `/api/strategy/project/update/${this.$route.params.id}`;
      this.axios.post(uri, this.strategy).then(response => {
        this.$router.push({ name: "strategy-projects" });
        this.$notify({ type: "success", text: "Änderungen gespeichert!" });
      });
    },

    // Store uploaded image
    storeImage(upload) {
      let image = {
        id: null,
        name: upload.name,
        caption: { de: null, en: null },
        is_preview_works: 0,
        coords_w: 0,
        coords_h: 0,
        coords_x: 0,
        coords_y: 0,
        orientation: upload.orientation,
        order: -1,
        publish: 1,
      }
      this.strategy.images.push(image);
    },

    // Delete by name
    destroyImage(image, event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/strategy/project/image/destroy/${image}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          const index = this.strategy.images.findIndex(x => x.name === image);
          this.strategy.images.splice(index, 1);
          this.progress(el);
        });
      }
    },

    // Toggle image status
    toggleImage(image, event) {
      if (image.id === null) {
        const index = this.strategy.images.findIndex(x => x.name === image.name);
        this.strategy.images[index].publish = image.publish == 1 ? 0 : 1;
      } else {
        let uri = `/api/strategy/project/image/status/${image.id}`;
        let el = this.progress(event.target);
        this.axios.get(uri).then(response => {
          const index = this.strategy.images.findIndex(x => x.id === image.id);
          this.strategy.images[index].publish = response.data;
          this.progress(el);
        });
      }
    },

    // Save coords
    saveImageCoords(image) {
      if (image.id === null) {
        const index = this.strategy.images.findIndex(x => x.name === image.name);
        this.strategy.images[index].coords = image.coords;
      } 
      else {
        let uri = `/api/strategy/project/image/coords/${image.id}`;
        this.axios.post(uri, image).then(response => {
          this.$notify({ type: "success", text: "Änderungen gespeichert!" });
        });
      }
    },
  },

  computed: {
    title: function() {
      return this.$props.type == "edit"
        ? "Strategie & Entwicklung Projekt bearbeiten"
        : "Strategie & Entwicklung Projekt hinzufügen";
    }
  }
};
</script>