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
                <div class="form-row">
                  <label>Text</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="projectText.text.de"
                  ></tinymce-editor>
                </div>
              </div>
              <div class="column-sidebar">
                <div>
                  <div class="form-row is-sm is-last">
                    <label class="is-sm">Publizieren?</label>
                    <div class="form-radio">
                      <input
                        v-model="projectText.publish"
                        type="radio"
                        name="publish_1"
                        id="publish_1"
                        value="1"
                        class="visually-hidden"
                      >
                      <label for="publish_1" class="form-control">Ja</label>
                      <input
                        v-model="projectText.publish"
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
                  <label>Text</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="projectText.text.en"
                  ></tinymce-editor>
                </div>
              </div>
            </div>
          </div>
          <footer class="site-footer">
            <div>
              <button type="submit" class="btn-secondary">Speichern</button>
              <router-link :to="{name: 'project-text', params: { id: $route.params.id }}">Zurück</router-link>
            </div>
          </footer>
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

// TinyMCE
import tinyConfig from "@/config/tinyconfig.js";
import TinymceEditor from "@tinymce/tinymce-vue";

// Mixins
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

// Config
import projectTextTabs from "@/components/projects/text/config/tabs.js";
import projectTextErrors from "@/components/projects/text/config/errors.js";

export default {
  components: {
    FormFooter,
    TinymceEditor,
    Tabs
  },

  props: {
    type: String
  },

  mixins: [Utils, Progress],

  data() {
    return {

      // project text validation
      errors: projectTextErrors,

      // project text tabs
      tabs: projectTextTabs,

      // project text model
      projectText: {
        text: {
          de: null,
          en: null,
        },
        publish: 0,
        project_id: null,
      },
 
      // TinyMCE
      tinyConfig: tinyConfig,
      tinyApiKey: 'vuaywur9klvlt3excnrd9xki1a5lj25v18b2j0d0nu5tbwro',
    };
  },

  created() {
    if (this.$props.type == "edit") {
      let uri = `/api/project/text/edit/${this.$route.params.id}`;
      this.axios.get(uri).then(response => {
        this.projectText = response.data;
        this.tabs.data.active = true;
      });
    }

    this.projectText.project_id = this.$route.params.id;
  },

  mounted() {
    this.removeErrors();
  },

  methods: {

    // Submit form
    submit() {

      if (this.$props.type == "edit") {
        this.update();
      }

      if (this.$props.type == "create") {
        this.store();
      }
    },

    // Store the project
    store() {
      let uri = `/api/project/text/create`;
      this.axios.post(uri, this.projectText).then(response => {
        this.$router.push({ name: "project-text", params: { id: this.projectText.project_id } });
        this.$notify({ type: "success", text: "Projekttext erfasst!" });
      });
    },

    // Update the project
    update() {
      let uri = `/api/project/text/update/${this.$route.params.id}`;
      this.axios.post(uri, this.projectText).then(response => {
        this.$router.push({ name: "project-text", params: { id: this.projectText.project_id } });
        this.$notify({ type: "success", text: "Änderungen gespeichert!" });
      });
    },
  },

  computed: {
    title: function() {
      return this.$props.type == "edit"
        ? "Projekttext bearbeiten"
        : "Projekttext hinzufügen";
    }
  }
};
</script>