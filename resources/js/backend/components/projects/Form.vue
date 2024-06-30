<template>
  <div class="container">
    <notifications classes="notification"/>
    <main class="content" role="main">
      <div>
        <h1>{{title}}</h1>
        <tabs :tabs="tabs" :errors="errors"></tabs>
        <form @submit.prevent="submit">
          <div v-show="tabs.data.active">
            <div class="grid-main-sidebar" v-if="isFetched">
              <div class="column-main">
                <div class="form-row" :class="errors.name.de ? 'has-error': ''">
                  <label>Name *</label>
                  <input type="text" @focus="removeError('name', 'de')" v-model="project.name.de">
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row" :class="errors.short_title.de ? 'has-error': ''">
                  <label>Kurztitel *</label>
                  <input type="text" @focus="removeError('short_title', 'de')" v-model="project.short_title.de">
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row" :class="errors.location.de ? 'has-error': ''">
                  <label>Ort *</label>
                  <input type="text" @focus="removeError('location', 'de')" v-model="project.location.de">
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row" :class="errors.type.de ? 'has-error': ''">
                  <label>Typ *</label>
                  <input
                    type="text"
                    @focus="removeError('type', 'de')"
                    v-model="project.type.de"
                  >
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row" :class="errors.year ? 'has-error': ''">
                  <label>Jahr *</label>
                  <input type="text" @focus="removeError('year')" v-model="project.year">
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row">
                  <label>Beschreibung</label>
                  <tinymce-editor
                    :init="tinyConfig"
                    v-model="project.description.de"
                  ></tinymce-editor>
                </div>
                <div class="form-row">
                  <label>Info</label>
                  <tinymce-editor
                    :init="tinyConfig"
                    v-model="project.info.de"
                  ></tinymce-editor>
                </div>
                <div class="form-row">
                  <label>Info Werkliste 2</label>
                  <input type="text" v-model="project.info_works_1.de">
                </div>
                <div class="form-row">
                  <label>Info Werkliste 3</label>
                  <input type="text" v-model="project.info_works_2.de">
                </div>
              </div>
              <div class="column-sidebar">
                <div>
                  <div class="form-row is-sm">
                    <label>Thema - Werkliste</label>
                    <div class="select-wrapper is-sidebar">
                      <select v-model="project.program_id" name="program">
                        <option v-for="p in programs" :key="p.id" :value="p.id">{{ p.title.de }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row is-sm">
                    <label>Interaktion</label>
                    <div class="select-wrapper is-sidebar">
                      <select v-model="project.interaction_id" name="interaction">
                        <option value="0">Bitte wählen...</option>
                        <option v-for="i in interactions" :key="i.id" :value="i.id">{{ i.title.de }}</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-row is-sm">
                    <label>Strategie &amp; Entwicklung</label>
                    <div class="select-wrapper is-sidebar">
                      <select v-model="project.strategy_project_id" name="strategy_project">
                        <option value="0">Bitte wählen...</option>
                        <option v-for="s in strategy_projects" :key="s.id" :value="s.id">{{ s.title.de }}</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-row is-sm">
                    <label>Navigation</label>
                    <div class="select-wrapper is-sidebar">
                      <select v-model="project.category" name="category">
                        <option v-for="(c, index) in categories" :key="index" :value="index">{{ c }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row is-sm">
                    <label class="is-sm">Detailseite?</label>
                    <div class="form-radio">
                      <input
                        v-model="project.has_detail"
                        type="radio"
                        name="has_detail_1"
                        id="has_detail_1"
                        value="1"
                        class="visually-hidden"
                      >
                      <label for="has_detail_1" class="form-control">Ja</label>
                      <input
                        v-model="project.has_detail"
                        type="radio"
                        name="has_detail_0"
                        id="has_detail_0"
                        value="0"
                        class="visually-hidden"
                      >
                      <label for="has_detail_0" class="form-control">Nein</label>
                    </div>
                  </div>
                  <div class="form-row is-sm is-last">
                    <label class="is-sm">Publizieren?</label>
                    <div class="form-radio">
                      <input
                        v-model="project.publish"
                        type="radio"
                        name="publish_1"
                        id="publish_1"
                        value="1"
                        class="visually-hidden"
                      >
                      <label for="publish_1" class="form-control">Ja</label>
                      <input
                        v-model="project.publish"
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
            <div class="grid-main-sidebar" v-if="isFetched">
              <div class="column-main">
                <div class="form-row">
                  <label>Name</label>
                  <input type="text" v-model="project.name.en">
                </div>
                <div class="form-row">
                  <label>Kurztitel</label>
                  <input type="text" v-model="project.short_title.en">
                </div>
                <div class="form-row">
                  <label>Ort</label>
                  <input type="text" v-model="project.location.en">
                </div>
                <div class="form-row">
                  <label>Typ</label>
                  <input type="text" v-model="project.type.en">
                </div>
                <div class="form-row">
                  <label>Beschreibung</label>
                  <tinymce-editor
                    :init="tinyConfig"
                    v-model="project.description.en"
                  ></tinymce-editor>
                </div>
                <div class="form-row">
                  <label>Info</label>
                  <tinymce-editor
                    :init="tinyConfig"
                    v-model="project.info.en"
                  ></tinymce-editor>
                </div>
                <div class="form-row">
                  <label>Info Werkliste 2</label>
                  <input type="text" v-model="project.info_works_1.en">
                </div>
                <div class="form-row">
                  <label>Info Werkliste 3</label>
                  <input type="text" v-model="project.info_works_2.en">
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
            <div class="form-row" v-if="project.images.length">
              <image-listing 
                :images="project.images"
                :imagePreviewRoute="'project'"
              ></image-listing>
            </div>
          </div>
          <div v-show="tabs.files.active">
            <div class="form-row" v-if="project.documents.length == 0">
              <file-upload
                :restrictions="'pdf | max. 8 MB'"
                :maxFiles="99"
                :maxFilesize="8"
                :acceptedFiles="'.pdf'"
              ></file-upload>
            </div>
            <div class="form-row" v-if="project.documents.length">
              <file-listing 
                :files="project.documents"
              ></file-listing>
            </div>
          </div>
          <form-footer :route="'projects'"></form-footer>
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
import ImageListing from "@/components/projects/images/Edit.vue";
import FileUpload from "@/components/global/files/Upload.vue";
import FileListing from "@/components/global/files/Edit.vue";

// TinyMCE
import tinyConfig from "@/config/tinyconfig.js";
import TinymceEditor from "@tinymce/tinymce-vue";

// Mixins
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

// Config
import projectTabs from "@/components/projects/config/tabs.js";
import projectErrors from "@/components/projects/config/errors.js";

export default {
  components: {
    FormFooter,
    TinymceEditor,
    FileUpload,
    FileListing,
    ImageUpload,
    ImageListing,
    Tabs,
  },

  props: {
    type: String
  },

  mixins: [Utils, Progress],

  data() {
    return {

      // project validation
      errors: projectErrors,

      // project tabs
      tabs: projectTabs,

      // project model
      project: {
        name: {
          de: null,
          en: null,
        },
        short_title: {
          de: null,
          en: null,
        },
        location: {
          de: null,
          en: null,
        },
        type: {
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
        info_works_1: {
          de: null,
          en: null,
        },
        info_works_2: {
          de: null,
          en: null,
        },
        year: null,
        program_id: 0,
        interaction_id: 0,
        category: 1,
        state: 1,
        images: [],
        documents: [],
        has_detail: 0,
        publish: 0,
      },

      // settings
      categories: [],
      programs: [],
      interactions: [],
      strategy_projects: [],

      // TinyMCE
      tinyConfig: tinyConfig,

      isFetched: true,
    };
  },

  created() {
    if (this.$props.type == "edit") {
      this.isFetched = false;
      let uri = `/api/project/edit/${this.$route.params.id}`;
      this.axios.get(uri).then(response => {
        this.project = response.data;
        this.tabs.data.active = true;
        this.isFetched = true;
      });
    }

    this.axios.get(`/api/settings/projectCategories`).then(response => {
      this.categories = response.data;
      delete this.categories[3]; 
    });

    this.axios.get(`/api/project/program/get`).then(response => {
      this.programs = response.data;
    });

    this.axios.get(`/api/interaction/projects/get`).then(response => {
      this.interactions = response.data;
    });

    this.axios.get(`/api/strategy/projects/get`).then(response => {
      this.strategy_projects = response.data;
    });

  },

  mounted() {
    this.removeErrors();
  },

  methods: {
    // Validation methods
    validate() {
      if (
        this.project.name.de &&
        this.project.short_title.de &&
        this.project.location.de &&
        this.project.type.de &&
        this.project.year &&
        this.project.images.length > 0
      ) {
        return true;
      }

      if (!this.project.name.de) {
        this.errors.name.de = true;
        this.tabs.data.error = true;
      }
      
      if (!this.project.short_title.de) {
        this.errors.short_title.de = true;
        this.tabs.data.error = true;
      }

      if (!this.project.location.de) {
        this.errors.location.de = true;
        this.tabs.data.error = true;
      }

      if (!this.project.type.de) {
        this.errors.type.de = true;
        this.tabs.data.error = true;
      }

      if (!this.project.year) {
        this.errors.year = true;
        this.tabs.data.error = true;
      }

      if (this.project.images.length == 0) {
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
      let uri = "/api/project/create";
      this.axios.post(uri, this.project).then(response => {
        this.$router.push({ name: "projects" });
        this.$notify({ type: "success", text: "Projekt erfasst!" });
      });
    },

    // Update the project
    update() {
      let uri = `/api/project/update/${this.$route.params.id}`;
      this.axios.post(uri, this.project).then(response => {
        this.$router.push({ name: "projects" });
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
        is_lightbox: 1,
        is_plan: 0,
        coords_w: 0,
        coords_h: 0,
        coords_x: 0,
        coords_y: 0,
        orientation: upload.orientation,
        order: -1,
        publish: 1,
      }
      this.project.images.push(image);
    },

    // Delete by name
    destroyImage(image, event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/project/image/destroy/${image}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          const index = this.project.images.findIndex(x => x.name === image);
          this.project.images.splice(index, 1);
          this.progress(el);
        });
      }
    },

    // Toggle image status
    toggleImage(image, event) {
      if (image.id === null) {
        const index = this.project.images.findIndex(x => x.name === image.name);
        this.project.images[index].publish = image.publish == 1 ? 0 : 1;
      } else {
        let uri = `/api/project/image/status/${image.id}`;
        let el = this.progress(event.target);
        this.axios.get(uri).then(response => {
          const index = this.project.images.findIndex(x => x.id === image.id);
          this.project.images[index].publish = response.data;
          this.progress(el);
        });
      }
    },

    // Save image coords
    saveImageCoords(image) {
      if (image.id === null) {
        const index = this.project.images.findIndex(x => x.name === image.name);
        this.project.images[index].coords = image.coords;
        this.$notify({ type: "success", text: "Änderungen gespeichert!" });
      } 
      else {
        let uri = `/api/project/image/coords/${image.id}`;
        this.axios.post(uri, image).then(response => {
          this.$notify({ type: "success", text: "Änderungen gespeichert!" });
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
      this.project.documents.push(file);
    },

    // Delete by name
    destroyFile(file, event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/project/document/destroy/${file}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          const index = this.project.documents.findIndex(x => x.name === file);
          this.project.documents.splice(index, 1);
          this.progress(el);
        });
      }
    },

    // Toggle file status
    toggleFile(file, event) {
      if (file.id === null) {
        const index = this.project.documents.findIndex(x => x.name === file.name);
        this.project.documents[index].publish = file.publish == 1 ? 0 : 1;
      } else {
        let uri = `/api/project/document/status/${file.id}`;
        let el = this.progress(event.target);
        this.axios.get(uri).then(response => {
          const index = this.project.documents.findIndex(x => x.id === file.id);
          this.project.documents[index].publish = response.data;
          this.progress(el);
        });
      }
    },

  },

  computed: {
    title: function() {
      return this.$props.type == "edit"
        ? "Projekt bearbeiten"
        : "Projekt hinzufügen";
    }
  }
}
</script>