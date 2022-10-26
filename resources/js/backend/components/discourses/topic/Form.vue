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
                  <label>Titel *</label>
                  <input type="text" @focus="removeError('title', 'de')" v-model="topic.title.de">
                  <div class="is-required">Pflichtfeld</div>
                </div>
                <div class="form-row is-sm is-last">
                  <label class="is-sm">Publizieren?</label>
                  <div class="form-radio">
                    <input
                      v-model="topic.publish"
                      type="radio"
                      name="publish_1"
                      id="publish_1"
                      value="1"
                      class="visually-hidden"
                    >
                    <label for="publish_1" class="form-control">Ja</label>
                    <input
                      v-model="topic.publish"
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
          <div v-show="tabs.translation.active">
            <div class="grid-main-sidebar">
              <div class="column-main">
                <div class="form-row">
                  <label>Titel</label>
                  <input type="text" v-model="topic.title.en">
                </div>
              </div>
            </div>
          </div>
          <form-footer :route="'discourse-topic'"></form-footer>
        </form>
      </div>
    </main>
  </div>
</template>
<script>
import PageHeader from "@/layout/PageHeader.vue";
import FormFooter from "@/components/global/form/Footer.vue";
import Tabs from "@/components/global/tabs/Tabs.vue";

// Mixins
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

// Config
import topicTabs from "@/components/discourses/topic/config/tabs.js";
import topicErrors from "@/components/discourses/topic/config/errors.js";

export default {
  components: {
    FormFooter,
    Tabs,
  },

  props: {
    type: String
  },

  mixins: [Utils, Progress],

  data() {
    return {

      // topic validation
      errors: topicErrors,

      // topic tabs
      tabs: topicTabs,

      // profile model
      topic: {
        title: {
          de: null,
          en: null,
        },
        publish: 0,
      },
    };
  },

  created() {
    if (this.$props.type == "edit") {
      let uri = `/api/discourse/topic/edit/${this.$route.params.id}`;
      this.axios.get(uri).then(response => {
        this.topic = response.data;
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
      if (this.topic.title.de) {
        return true;
      }

      if (!this.topic.title.de) {
        this.errors.title.de = true;
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

    // Store the topic
    store() {
      let uri = "/api/discourse/topic/create";
      this.axios.post(uri, this.topic).then(response => {
        this.$router.push({ name: "discourse-topic" });
        this.$notify({ type: "success", text: "Text erfasst!" });
      });
    },

    // Update the topic
    update() {
      let uri = `/api/discourse/topic/update/${this.$route.params.id}`;
      this.axios.post(uri, this.topic).then(response => {
        this.$router.push({ name: "discourse-topic" });
        this.$notify({ type: "success", text: "Änderungen gespeichert!" });
      });
    },
  },

  computed: {
    title: function() {
      return this.$props.type == "edit"
        ? "Kategorie bearbeiten"
        : "Kategorie hinzufügen";
    }
  }
};
</script>