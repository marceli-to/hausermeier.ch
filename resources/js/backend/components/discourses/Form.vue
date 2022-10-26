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
                <div class="form-row" :class="errors.date ? 'has-error': ''">
                  <label>Datum *</label>
                  <input
                    type="text"
                    @focus="removeError('date')"
                    v-model="discourse.date"
                  >
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row" :class="errors.title.de ? 'has-error': ''">
                  <label>Titel *</label>
                  <input
                    type="text"
                    @focus="removeError('title', 'de')"
                    v-model="discourse.title.de"
                  >
                  <div class="is-required">Pflichtfeld</div>
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
                    v-model="discourse.description.de"
                  ></tinymce-editor>
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row is-last">
                  <label>Info</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="discourse.info.de"
                  ></tinymce-editor>
                </div>
              </div>
              <div class="column-sidebar">
                <div>
                  <div class="form-row is-sm">
                    <label>Projekt</label>
                    <div class="select-wrapper is-sidebar">
                      <select v-model="discourse.project_id" name="project_id">
                        <option value="0">Bitte wählen...</option>
                        <option v-for="p in projects" :key="p.id" :value="p.id">{{ p.name.de }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row is-sm">
                    <label>Interaktion</label>
                    <div class="select-wrapper is-sidebar">
                      <select v-model="discourse.interaction_project_id" name="interaction_project_id">
                        <option value="0">Bitte wählen...</option>
                        <option v-for="i in interactions" :key="i.id" :value="i.id">{{ i.title.de }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row is-sm">
                    <label>Strategie &amp; Entwicklung</label>
                    <div class="select-wrapper is-sidebar">
                      <select v-model="discourse.strategy_project_id" name="strategy_project_id">
                        <option value="0">Bitte wählen...</option>
                        <option v-for="s in strategies" :key="s.id" :value="s.id">{{ s.title.de }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row is-sm">
                    <label class="is-sm">Alle?</label>
                    <div class="form-radio">
                      <input
                        v-model="discourse.is_all"
                        type="radio"
                        name="is_all_1"
                        id="is_all_1"
                        value="1"
                        class="visually-hidden"
                      >
                      <label for="is_all_1" class="form-control">Ja</label>
                      <input
                        v-model="discourse.is_all"
                        type="radio"
                        name="is_all_0"
                        id="is_all_0"
                        value="0"
                        class="visually-hidden"
                      >
                      <label for="is_all_0" class="form-control">Nein</label>
                    </div>
                  </div>
                  <div class="form-row is-sm">
                    <label class="is-sm">Diskurs?</label>
                    <div class="form-radio">
                      <input
                        v-model="discourse.is_discourse"
                        type="radio"
                        name="is_discourse_1"
                        id="is_discourse_1"
                        value="1"
                        class="visually-hidden"
                      >
                      <label for="is_discourse_1" class="form-control">Ja</label>
                      <input
                        v-model="discourse.is_discourse"
                        type="radio"
                        name="is_discourse_0"
                        id="is_discourse_0"
                        value="0"
                        class="visually-hidden"
                      >
                      <label for="is_discourse_0" class="form-control">Nein</label>
                    </div>
                  </div>
                  <div class="form-row is-sm">
                    <label class="is-sm">Publikation?</label>
                    <div class="form-radio">
                      <input
                        v-model="discourse.is_publication"
                        type="radio"
                        name="is_publication_1"
                        id="is_publication_1"
                        value="1"
                        class="visually-hidden"
                      >
                      <label for="is_publication_1" class="form-control">Ja</label>
                      <input
                        v-model="discourse.is_publication"
                        type="radio"
                        name="is_publication_0"
                        id="is_publication_0"
                        value="0"
                        class="visually-hidden"
                      >
                      <label for="is_publication_0" class="form-control">Nein</label>
                    </div>
                  </div>
                  <div class="form-row is-sm is-last">
                    <label class="is-sm">Publizieren?</label>
                    <div class="form-radio">
                      <input
                        v-model="discourse.publish"
                        type="radio"
                        name="publish_1"
                        id="publish_1"
                        value="1"
                        class="visually-hidden"
                      >
                      <label for="publish_1" class="form-control">Ja</label>
                      <input
                        v-model="discourse.publish"
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
                  <label>Titel</label>
                  <input type="text" v-model="discourse.title.en">
                </div>
                <div class="form-row">
                  <label>Beschreibung</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="discourse.description.en"
                  ></tinymce-editor>
                </div>
                <div class="form-row is-last">
                  <label>Info</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="discourse.info.en"
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
            <div class="form-row" v-if="discourse.images.length">
              <image-listing 
                :images="discourse.images"
                :imagePreviewRoute="'discourse'"
              ></image-listing>
            </div>
          </div>
          <div v-show="tabs.files.active">
            <div class="form-row">
              <file-upload
                :restrictions="'pdf | max. 8 MB'"
                :maxFiles="99"
                :maxFilesize="8"
                :acceptedFiles="'.pdf'"
              ></file-upload>
            </div>
            <div class="form-row" v-if="discourse.documents.length">
              <file-listing 
                :files="discourse.documents"
              ></file-listing>
            </div>
          </div>
          <form-footer :route="'discourses'"></form-footer>
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
import ImageListing from "@/components/discourses/images/Edit.vue";
import FileUpload from "@/components/global/files/Upload.vue";
import FileListing from "@/components/global/files/Edit.vue";

// TinyMCE
import tinyConfig from "@/config/tinyconfig.js";
import TinymceEditor from "@tinymce/tinymce-vue";

// Mixins
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

// Config
import discourseTabs from "@/components/discourses/config/tabs.js";
import discourseErrors from "@/components/discourses/config/errors.js";

export default {
  components: {
    FormFooter,
    TinymceEditor,
    FileUpload,
    FileListing,
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

      // discourse validation
      errors: discourseErrors,

      // discourse tabs
      tabs: discourseTabs,

      // discourse model
      discourse: {
        date: null,
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
          en: null,
        },
        is_all: 0,
        is_discourse: 1,
        is_publication: 0,
        images: [],
        documents: [],
        publish: 0,
        project_id: null,
        interaction_project_id: null,
        strategy_project_id: null,
        topic_id: 1,
      },

      // settings
      projects: [],
      interactions: [],
      strategies: [],

      // TinyMCE
      tinyConfig: tinyConfig,
      tinyApiKey: 'vuaywur9klvlt3excnrd9xki1a5lj25v18b2j0d0nu5tbwro',
    };
  },

  created() {
    if (this.$props.type == "edit") {
      let uri = `/api/discourse/edit/${this.$route.params.id}`;
      this.axios.get(uri).then(response => {
        this.discourse = response.data;
        this.tabs.data.active = true;
      });
    }

    this.axios.get(`/api/projects/get`).then(response => {
      this.projects = response.data.data;
    });

    this.axios.get(`/api/interaction/projects/get`).then(response => {
      this.interactions = response.data;
    });

    this.axios.get(`/api/strategy/projects/get`).then(response => {
      this.strategies = response.data;
    });

  },

  mounted() {
    this.removeErrors();
  },

  methods: {
    // Validation methods
    validate() {
      if (
        this.discourse.date &&
        this.discourse.title.de &&
        this.discourse.description.de &&
        this.discourse.images.length > 0
      ) {
        return true;
      }

      if (!this.discourse.date) {
        this.errors.date = true;
        this.tabs.data.error = true;
      }

      if (!this.discourse.title.de) {
        this.errors.title.de = true;
        this.tabs.data.error = true;
      }

      if (!this.discourse.description.de) {
        this.errors.description.de = true;
        this.tabs.data.error = true;
      }

      if (this.discourse.images.length == 0) {
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
      let uri = "/api/discourse/create";
      this.axios.post(uri, this.discourse).then(response => {
        this.$router.push({ name: "discourses" });
        this.$notify({ type: "success", text: "Diskurs erfasst!" });
      });
    },

    // Update the project
    update() {
      let uri = `/api/discourse/update/${this.$route.params.id}`;
      this.axios.post(uri, this.discourse).then(response => {
        this.$router.push({ name: "discourses" });
        this.$notify({ type: "success", text: "Änderungen gespeichert!" });
      });
    },

    // Store uploaded image
    storeImage(upload) {
      let image = {
        id: null,
        name: upload.name,
        caption: { de: null, en: null },
        is_preview: 0,
        coords_w: 0,
        coords_h: 0,
        coords_x: 0,
        coords_y: 0,
        orientation: upload.orientation,
        publish: 1,
      }
      this.discourse.images.push(image);
    },

    // Delete by name
    destroyImage(image, event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/discourse/image/destroy/${image}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          const index = this.discourse.images.findIndex(x => x.name === image);
          this.discourse.images.splice(index, 1);
          this.progress(el);
        });
      }
    },

    // Toggle image status
    toggleImage(image, event) {
      if (image.id === null) {
        const index = this.discourse.images.findIndex(x => x.name === image.name);
        this.discourse.images[index].publish = image.publish == 1 ? 0 : 1;
      } else {
        let uri = `/api/discourse/image/status/${image.id}`;
        let el = this.progress(event.target);
        this.axios.get(uri).then(response => {
          const index = this.discourse.images.findIndex(x => x.id === image.id);
          this.discourse.images[index].publish = response.data;
          this.progress(el);
        });
      }
    },

    // Store uploaded file
    storeFile(upload) {
      let file = {
        id: null,
        name: upload.name,
        caption: { de: null, en: null },
        publish: 1,
      }
      this.discourse.documents.push(file);
    },

    // Delete by name
    destroyFile(file, event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/discourse/document/destroy/${file}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          const index = this.discourse.documents.findIndex(x => x.name === file);
          this.discourse.documents.splice(index, 1);
          this.progress(el);
        });
      }
    },

    // Toggle file status
    toggleFile(file, event) {
      if (file.id === null) {
        const index = this.discourse.documents.findIndex(x => x.name === file.name);
        this.discourse.documents[index].publish = file.publish == 1 ? 0 : 1;
      } else {
        let uri = `/api/discourse/document/status/${file.id}`;
        let el = this.progress(event.target);
        this.axios.get(uri).then(response => {
          const index = this.discourse.documents.findIndex(x => x.id === file.id);
          this.discourse.documents[index].publish = response.data;
          this.progress(el);
        });
      }
    },

    // Save coords
    saveImageCoords(image) {
      if (image.id === null) {
        const index = this.discourse.images.findIndex(x => x.name === image.name);
        this.discourse.images[index].coords = image.coords;
      } 
      else {
        let uri = `/api/discourse/image/coords/${image.id}`;
        this.axios.post(uri, image).then(response => {
          this.$notify({ type: "success", text: "Änderungen gespeichert!" });
        });
      }
    },
  },

  computed: {
    title: function() {
      return this.$props.type == "edit"
        ? "Eintrag bearbeiten"
        : "Eintrag hinzufügen";
    }
  }
};
</script>