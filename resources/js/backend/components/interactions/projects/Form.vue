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
                    v-model="interaction.category.de"
                  >
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row" :class="errors.title.de ? 'has-error': ''">
                  <label>Titel *</label>
                  <input
                    type="text"
                    @focus="removeError('title', 'de')"
                    v-model="interaction.title.de"
                  >
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row">
                  <label>Jahr</label>
                  <input type="text" v-model="interaction.year">
                </div>
                <div class="form-row">
                  <label>Link</label>
                  <input type="text" v-model="interaction.link">
                </div>
                <div class="form-row">
                  <label>Link Text</label>
                  <input type="text" v-model="interaction.linkText">
                </div>
                <div class="form-row">
                  <label>Video (Vimeo Link)</label>
                  <input type="text" v-model="interaction.video">
                </div>
                <div
                  class="form-row"
                  :class="errors.description.de ? 'has-error': ''"
                  @mouseenter="removeError('description', 'de')"
                >
                  <label>Beschreibung *</label>
                  <tinymce-editor
                    :init="tinyConfig"
                    v-model="interaction.description.de"
                  ></tinymce-editor>
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row is-last">
                  <label>Info</label>
                  <tinymce-editor
                    :init="tinyConfig"
                    v-model="interaction.info.de"
                  ></tinymce-editor>
                </div>
              </div>
              <div class="column-sidebar">
                <div>
                  <div class="form-row is-sm">
                    <label>Projekt</label>
                    <div class="select-wrapper is-sidebar">
                      <select v-model="interaction.project_id" name="project_id">
                        <option v-for="p in projects" :key="p.id" :value="p.id">{{ p.name.de }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row is-sm is-last">
                    <label class="is-sm">Publizieren?</label>
                    <div class="form-radio">
                      <input
                        v-model="interaction.publish"
                        type="radio"
                        name="publish_1"
                        id="publish_1"
                        value="1"
                        class="visually-hidden"
                      >
                      <label for="publish_1" class="form-control">Ja</label>
                      <input
                        v-model="interaction.publish"
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
                  <input type="text" v-model="interaction.category.en">
                </div>
                <div class="form-row">
                  <label>Titel</label>
                  <input type="text" v-model="interaction.title.en">
                </div>
                <div class="form-row">
                  <label>Beschreibung</label>
                  <tinymce-editor
                    :init="tinyConfig"
                    v-model="interaction.description.en"
                  ></tinymce-editor>
                </div>
                <div class="form-row is-last">
                  <label>Info</label>
                  <tinymce-editor
                    :init="tinyConfig"
                    v-model="interaction.info.en"
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
            <div class="form-row" v-if="interaction.images.length">
              <image-listing 
                :images="interaction.images"
                :imagePreviewRoute="'interaction-project'"
              ></image-listing>
            </div>
          </div>
          <form-footer :route="'interaction-projects'"></form-footer>
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
import ImageListing from "@/components/interactions/projects/images/Edit.vue";

// TinyMCE
import tinyConfig from "@/config/tinyconfig.js";
import TinymceEditor from "@tinymce/tinymce-vue";

// Mixins
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

// Config
import interactionTabs from "@/components/interactions/projects/config/tabs.js";
import interactionErrors from "@/components/interactions/projects/config/errors.js";

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

      // interaction validation
      errors: interactionErrors,

      // interaction tabs
      tabs: interactionTabs,

      // interaction model
      interaction: {
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
        year: null,
        link: null,
        linkText: null,
        video: null,
        images: [],
        publish: 0,
        project_id: null,
      },

      // settings
      projects: [],

      // TinyMCE
      tinyConfig: tinyConfig,
    };
  },

  created() {
    if (this.$props.type == "edit") {
      let uri = `/api/interaction/project/edit/${this.$route.params.id}`;
      this.axios.get(uri).then(response => {
        this.interaction = response.data;
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
        this.interaction.category.de &&
        this.interaction.title.de &&
        this.interaction.description.de &&
        this.interaction.images.length > 0
      ) {
        return true;
      }

      if (!this.interaction.category.de) {
        this.errors.category.de = true;
        this.tabs.data.error = true;
      }

      if (!this.interaction.title.de) {
        this.errors.title.de = true;
        this.tabs.data.error = true;
      }

      if (!this.interaction.description.de) {
        this.errors.description.de = true;
        this.tabs.data.error = true;
      }

      if (this.interaction.images.length == 0) {
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
      let uri = "/api/interaction/project/create";
      this.axios.post(uri, this.interaction).then(response => {
        this.$router.push({ name: "interaction-projects" });
        this.$notify({ type: "success", text: "Diskurs erfasst!" });
      });
    },

    // Update the project
    update() {
      let uri = `/api/interaction/project/update/${this.$route.params.id}`;
      this.axios.post(uri, this.interaction).then(response => {
        this.$router.push({ name: "interaction-projects" });
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
        orientation: upload.orientation,
        order: -1,
        publish: 1,
      }
      this.interaction.images.push(image);
    },

    // Delete by name
    destroyImage(image, event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/interaction/project/image/destroy/${image}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          const index = this.interaction.images.findIndex(x => x.name === image);
          this.interaction.images.splice(index, 1);
          this.progress(el);
        });
      }
    },

    // Toggle image status
    toggleImage(image, event) {
      if (image.id === null) {
        const index = this.interaction.images.findIndex(x => x.name === image.name);
        this.interaction.images[index].publish = image.publish == 1 ? 0 : 1;
      } else {
        let uri = `/api/interaction/project/image/status/${image.id}`;
        let el = this.progress(event.target);
        this.axios.get(uri).then(response => {
          const index = this.interaction.images.findIndex(x => x.id === image.id);
          this.interaction.images[index].publish = response.data;
          this.progress(el);
        });
      }
    },

    // Save coords
    saveImageCoords(image) {
      if (image.id === null) {
        const index = this.interaction.images.findIndex(x => x.name === image.name);
        this.interaction.images[index].coords = image.coords;
      } 
      else {
        let uri = `/api/interaction/project/image/coords/${image.id}`;
        this.axios.post(uri, image).then(response => {
          this.$notify({ type: "success", text: "Änderungen gespeichert!" });
        });
      }
    },
  },

  computed: {
    title: function() {
      return this.$props.type == "edit"
        ? "Interaktion Projekt bearbeiten"
        : "Interaktion Projekt hinzufügen";
    }
  }
};
</script>