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
                <div class="form-row" :class="errors.title.de ? 'has-error': ''">
                  <form-text 
                    v-model="job.title.de"
                    :label="'Titel'"
                    :name="'title'"
                    :language="'de'"
                    :required="true"
                  ></form-text>
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
                    v-model="job.description.de"
                  ></tinymce-editor>
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row is-last">
                  <label>Info</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="job.info.de"
                  ></tinymce-editor>
                </div>
              </div>
              <div class="column-sidebar">
                <div>
                  <div class="form-row is-sm is-last">
                    <label class="is-sm">Publizieren?</label>
                    <div class="form-radio">
                      <input
                        v-model="job.publish"
                        type="radio"
                        name="publish_1"
                        id="publish_1"
                        value="1"
                        class="visually-hidden"
                      >
                      <label for="publish_1" class="form-control">Ja</label>
                      <input
                        v-model="job.publish"
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
                  <form-text 
                    v-model="job.title.en"
                    :label="'Titel'"
                    :name="'title'"
                    :language="'en'"
                  ></form-text>
                </div>
                <div class="form-row">
                  <label>Beschreibung</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="job.description.en"
                  ></tinymce-editor>
                </div>
                <div class="form-row is-last">
                  <label>Info</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="job.info.en"
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
            <div class="form-row">
              <image-edit 
                :images="job.images"
                :imagePreviewRoute="'job'"
                :aspectRatioW="4"
                :aspectRatioH="3"
              ></image-edit>
            </div>
          </div>
          <form-footer :route="'jobs'"></form-footer>
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
import FormText from "@/components/global/input/Text.vue"

// Tabs
import Tabs from "@/components/global/tabs/Tabs.vue";

// Upload
import ImageUpload from "@/components/global/images/Upload.vue";
import ImageEdit from "@/components/global/images/Edit.vue";

// TinyMCE
import tinyConfig from "@/config/tinyconfig.js";
import TinymceEditor from "@tinymce/tinymce-vue";

// Mixins
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

// Config
import jobTabs from "@/components/jobs/config/tabs.js";
import jobErrors from "@/components/jobs/config/errors.js";

export default {
  components: {
    FormFooter,
    FormText,
    TinymceEditor,
    ImageUpload,
    ImageEdit,
    Tabs
  },

  props: {
    type: String
  },

  mixins: [Utils, Progress],

  data() {
    return {
      // job validation
      errors: jobErrors,

      // job tabs
      tabs: jobTabs,

      // job model
      job: {
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
        images: [],
        publish: 0,
      },

      // TinyMCE
      tinyConfig: tinyConfig,
      tinyApiKey: 'vuaywur9klvlt3excnrd9xki1a5lj25v18b2j0d0nu5tbwro',
    };
  },

  created() {
    if (this.$props.type == "edit") {
      let uri = `/api/job/edit/${this.$route.params.id}`;
      this.axios.get(uri).then(response => {
        this.job = response.data;
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
      if (this.job.title.de && this.job.description.de && this.job.images.length > 0) {
        return true;
      }

      if (!this.job.title.de) {
        this.errors.title.de = true;
        this.tabs.data.error = true;
      }

      if (!this.job.description.de) {
        this.errors.description.de = true;
        this.tabs.data.error = true;
      }
      
      if (this.job.images.length == 0) {
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

    // Store the job
    store() {
      let uri = "/api/job/create";
      this.axios.post(uri, this.job).then(response => {
        this.$router.push({ name: "jobs" });
        this.$notify({ type: "success", text: "Job erfasst!" });
      });
    },

    // Update the job
    update() {
      let uri = `/api/job/update/${this.$route.params.id}`;
      this.axios.post(uri, this.job).then(response => {
        this.$router.push({ name: "jobs" });
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
      this.job.images.push(image);
    },

    // Delete by name
    destroyImage(image, event) {
      if (confirm("Please confirm!")) {
        let uri = `/api/job/image/destroy/${image}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          const index = this.job.images.findIndex(x => x.name === image);
          this.job.images.splice(index, 1);
          this.progress(el);
        });
      }
    },

    // Toggle status
    toggleImage(image, event) {
      if (image.id === null) {
        const index = this.job.images.findIndex(x => x.name === image.name);
        this.job.images[index].publish = image.publish == 1 ? 0 : 1;
      } else {
        let uri = `/api/job/image/status/${image.id}`;
        let el = this.progress(event.target);
        this.axios.get(uri).then(response => {
          const index = this.job.images.findIndex(x => x.id === image.id);
          this.job.images[index].publish = response.data;
          this.progress(el);
        });
      }
    },

    // Save coords
    saveImageCoords(image) {
      if (image.id === null) {
        const index = this.job.images.findIndex(x => x.name === image.name);
        this.job.images[index].coords = image.coords;
      } 
      else {
        let uri = `/api/job/image/coords/${image.id}`;
        this.axios.post(uri, image).then(response => {
          this.$notify({ type: "success", text: "Änderungen gespeichert!" });
        });
      }
    },
  },

  computed: {
    title: function() {
      return this.$props.type == "edit" ? "Job bearbeiten" : "Job hinzufügen";
    }
  }
};
</script>