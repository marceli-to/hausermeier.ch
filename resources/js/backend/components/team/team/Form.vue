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
                <div class="form-row" :class="errors.firstname ? 'has-error': ''">
                  <label>Vorname *</label>
                  <input type="text" @focus="removeError('firstname')" v-model="team.firstname">
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row" :class="errors.name ? 'has-error': ''">
                  <label>Name *</label>
                  <input
                    type="text"
                    @focus="removeError('name')"
                    v-model="team.name"
                  >
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row">
                  <label>E-Mail</label>
                  <input
                    type="text"
                    v-model="team.email"
                  >
                </div>
                <div class="form-row">
                  <label>Funktion</label>
                  <textarea v-model="team.role.de"></textarea>
                </div>
                <div class="form-row">
                  <label>Telefon</label>
                  <input
                    type="text"
                    v-model="team.phone"
                  >
                </div>
                <div class="form-row is-last">
                  <label>Biographie</label>
                  <tinymce-editor
                    api-key="vuaywur9klvlt3excnrd9xki1a5lj25v18b2j0d0nu5tbwro"
                    :init="tinyConfig"
                    v-model="team.biography.de"
                  ></tinymce-editor>
                </div>
              </div>
              <div class="column-sidebar">
                <div>
                  <div class="form-row is-sm">
                    <label>Kategorie</label>
                    <div class="select-wrapper is-sidebar">
                      <select v-model="team.category" name="category">
                        <option v-for="(c, index) in categories" :key="index" :value="index">{{ c }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row is-sm is-last">
                    <label class="is-sm">Publizieren?</label>
                    <div class="form-radio">
                      <input
                        v-model="team.publish"
                        type="radio"
                        name="publish_1"
                        id="publish_1"
                        value="1"
                        class="visually-hidden"
                      >
                      <label for="publish_1" class="form-control">Ja</label>
                      <input
                        v-model="team.publish"
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
                  <label>Funktion</label>
                  <input type="text" v-model="team.role.en">
                </div>
                <div class="form-row is-last">
                  <label>Biographie</label>
                  <tinymce-editor
                    api-key="vuaywur9klvlt3excnrd9xki1a5lj25v18b2j0d0nu5tbwro"
                    :init="tinyConfig"
                    v-model="team.biography.en"
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
                :images="team.portrait"
                :imagePreviewRoute="'portrait'"
                :aspectRatioW="4"
                :aspectRatioH="3"
              ></image-edit>
            </div>
          </div>
          <form-footer :route="'team'"></form-footer>
        </form>
      </div>
    </main>
  </div>
</template>
<script>
import PageHeader from "@/layout/PageHeader.vue";
import FormFooter from "@/components/global/form/Footer.vue";
import Tabs from "@/components/global/tabs/Tabs.vue";

// TinyMCE
import TinymceEditor from "@tinymce/tinymce-vue";
import tinyConfig from "@/config/tinyconfig.js";

// Mixins
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

// Images
import ImageUpload from "@/components/global/images/Upload.vue";
import ImageEdit from "@/components/global/images/Edit.vue";

// Config
import teamTabs from "@/components/team/team/config/tabs.js";
import teamErrors from "@/components/team/team/config/errors.js";

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

      // team validation
      errors: teamErrors,

      // team tabs
      tabs: teamTabs,

      // team model
      team: {
        firstname: null,
        name: null,
        email: null,
        phone: null,
        role: {
          de: null,
          en: null,
        },
        biography: {
          de: null,
          en: null,
        },
        portrait: [],
        publish: 0,
        category: 1,
      },

      // settings
      categories: [],

      // tinymce config
      tinyConfig: tinyConfig
    };
  },

  created() {
    if (this.$props.type == "edit") {
      let uri = `/api/team/edit/${this.$route.params.id}`;
      this.axios.get(uri).then(response => {
        this.team = response.data;
        this.tabs.data.active = true;
      });
    }

    this.axios.get(`/api/settings/teamCategories`).then(response => {
      this.categories = response.data;
    });

  },

  mounted() {
    this.removeErrors();
  },

  methods: {
    // Validation methods
    validate() {
      if (
        this.team.firstname &&
        this.team.name
      ) {
        return true;
      }

      if (!this.team.firstname) {
        this.errors.firstname = true;
        this.tabs.data.error = true;
      }

      if (!this.team.name) {
        this.errors.name = true;
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

    // Store the team member
    store() {
      let uri = "/api/team/create";
      this.axios.post(uri, this.team).then(response => {
        this.$router.push({ name: "team" });
      });
    },

    // Update the team member
    update() {
      let uri = `/api/team/update/${this.$route.params.id}`;
      this.axios.post(uri, this.team).then(response => {
        this.$router.push({ name: "team" });
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
      this.team.portrait.push(image);
    },

    // Delete by name
    destroyImage(image, event) {
      if (confirm("Please confirm!")) {
        let uri = `/api/team/portrait/destroy/${image}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          const index = this.team.portrait.findIndex(x => x.name === image);
          this.team.portrait.splice(index, 1);
          this.progress(el);
        });
      }
    },

    // Toggle status
    toggleImage(image, event) {
      if (image.id === null) {
        const index = this.team.portrait.findIndex(x => x.name === image.name);
        this.team.portrait[index].publish = image.publish == 1 ? 0 : 1;
      } else {
        let uri = `/api/team/portrait/status/${image.id}`;
        let el = this.progress(event.target);
        this.axios.get(uri).then(response => {
          const index = this.team.portrait.findIndex(x => x.id === image.id);
          this.team.portrait[index].publish = response.data;
          this.progress(el);
        });
      }
    },

    // Save coords
    saveImageCoords(image) {
      if (image.id === null) {
        const index = this.team.portrait.findIndex(x => x.name === image.name);
        this.team.portrait[index].coords = image.coords;
      } 
      else {
        let uri = `/api/team/portrait/coords/${image.id}`;
        this.axios.post(uri, image).then(response => {
          this.$notify({ type: "success", text: "Änderungen gespeichert!" });
        });
      }
    },
  },

  computed: {
    title: function() {
      return this.$props.type == "edit"
        ? "Teammitglied bearbeiten"
        : "Teammitglied hinzufügen";
    }
  }
};
</script>