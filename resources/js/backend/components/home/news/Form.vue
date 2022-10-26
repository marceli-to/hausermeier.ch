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
                  <label>Datum</label>
                  <input
                    type="text"
                    v-model="news.date.de"
                  >
                </div>
                <div class="form-row">
                  <label>Titel</label>
                  <input
                    type="text"
                    v-model="news.title.de"
                  >
                </div>
                <div class="form-row">
                  <label>Kurztitel</label>
                  <input
                    type="text"
                    v-model="news.short_title.de"
                  >
                </div>
                <div class="form-row">
                  <label>Beschreibung</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="news.description.de"
                  ></tinymce-editor>
                </div>
                <div class="form-row">
                  <label>
                    Link
                    <a
                      :href="linkPreviewDe"
                      target="_blank"
                      class="icon-external-link is-sm icon-mini"
                      v-if="linkPreviewDe"
                    ></a>
                  </label>
                  <input 
                    type="text" 
                    v-model="news.link.de"
                    placeholder="https://test.ch/"
                    @blur="fixUri('de')"
                  >
                </div>
                <div class="form-row">
                  <label>Link Text</label>
                  <input type="text" v-model="news.linkText.de">
                </div>
              </div>
              <div class="column-sidebar">
                <div>
                  <div class="form-row is-sm">
                    <label>Layout</label>
                    <div class="select-wrapper is-sidebar">
                      <select v-model="news.layout" name="layout">
                        <option v-for="(l, index) in layouts" :key="index" :value="index">{{ l }}</option>
                      </select>
                    </div>
                  </div>              
                  <div class="form-row is-sm is-last">
                    <label class="is-sm">Publizieren?</label>
                    <div class="form-radio">
                      <input
                        v-model="news.publish"
                        type="radio"
                        name="publish_1"
                        id="publish_1"
                        value="1"
                        class="visually-hidden"
                      >
                      <label for="publish_1" class="form-control">Ja</label>
                      <input
                        v-model="news.publish"
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
                  <label>Datum</label>
                  <input type="text" v-model="news.date.en">
                </div>
                <div class="form-row">
                  <label>Titel</label>
                  <input type="text" v-model="news.title.en">
                </div>
                <div class="form-row">
                  <label>Kurztitel</label>
                  <input type="text" v-model="news.short_title.en">
                </div>
                <div class="form-row">
                  <label>Beschreibung</label>
                  <tinymce-editor
                    :api-key="tinyApiKey"
                    :init="tinyConfig"
                    v-model="news.description.en"
                  ></tinymce-editor>
                </div>
                <div class="form-row">
                  <label>
                    Link
                    <a
                      :href="linkPreviewEn"
                      target="_blank"
                      class="icon-external-link is-sm icon-mini"
                      v-if="linkPreviewEn"
                    ></a>
                  </label>
                  <input 
                    type="text" 
                    v-model="news.link.en"
                    placeholder="https://test.ch/"
                    @blur="fixUri('en')"
                  >
                </div>
                <div class="form-row">
                  <label>Link Text</label>
                  <input type="text" v-model="news.linkText.en">
                </div>
              </div>
            </div>
          </div>
          <div v-show="tabs.images.active">
            <div class="form-row" v-if="news.images.length == 0">
              <image-upload
                :restrictions="'jpg, png | max. 8 MB'"
                :maxFiles="1"
                :maxFilesize="8"
                :acceptedFiles="'.png,.jpg'"
              ></image-upload>
            </div>
            <div class="form-row" v-if="news.images.length">
              <image-listing 
                :images="news.images"
                :imagePreviewRoute="'news'"
              ></image-listing>
            </div>
          </div>
          <form-footer :route="'home-news'"></form-footer>
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
import ImageListing from "@/components/global/images/Edit.vue";

// TinyMCE
import tinyConfig from "@/config/tinyconfig.js";
import TinymceEditor from "@tinymce/tinymce-vue";

// Mixins
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

// Config
import newsTabs from "@/components/home/news/config/tabs.js";
import newsErrors from "@/components/home/news/config/errors.js";

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

      // news validation
      errors: newsErrors,

      // news tabs
      tabs: newsTabs,

      // news model
      news: {
        date: {
          de: null,
          en: null,
        },
        short_title: {
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
        link: {
          de: null,
          en: null,
        },
        linkText: {
          de: null,
          en: null,
        },
        images: [],
        publish: 0,
        layout: null,
      },

      // settings
      layouts: [],

      linkPreviewDe: null,
      linkPreviewEn: null,
  
      // TinyMCE
      tinyConfig: tinyConfig,
      tinyApiKey: 'vuaywur9klvlt3excnrd9xki1a5lj25v18b2j0d0nu5tbwro',
    };
  },

  created() {
    if (this.$props.type == "edit") {
      let uri = `/api/home/news/edit/${this.$route.params.id}`;
      this.axios.get(uri).then(response => {
        this.news = response.data;
        this.tabs.data.active = true;
      });
    }

    this.axios.get(`/api/settings/newsLayout`).then(response => {
      this.layouts = response.data;
    });
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
      let uri = "/api/home/news/create";
      this.axios.post(uri, this.news).then(response => {
        this.$router.push({ name: "home-news" });
        this.$notify({ type: "success", text: "News erfasst!" });
      });
    },

    // Update the project
    update() {
      let uri = `/api/home/news/update/${this.$route.params.id}`;
      this.axios.post(uri, this.news).then(response => {
        this.$router.push({ name: "home-news" });
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
        publish: 1,
      }
      this.news.images.push(image);
    },

    // Delete by name
    destroyImage(image, event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/home/news/image/destroy/${image}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          const index = this.news.images.findIndex(x => x.name === image);
          this.news.images.splice(index, 1);
          this.progress(el);
        });
      }
    },

    // Toggle image status
    toggleImage(image, event) {
      if (image.id === null) {
        const index = this.news.images.findIndex(x => x.name === image.name);
        this.news.images[index].publish = image.publish == 1 ? 0 : 1;
      } else {
        let uri = `/api/home/news/image/status/${image.id}`;
        let el = this.progress(event.target);
        this.axios.get(uri).then(response => {
          const index = this.news.images.findIndex(x => x.id === image.id);
          this.news.images[index].publish = response.data;
          this.progress(el);
        });
      }
    },

    // Save coords
    saveImageCoords(image) {
      if (image.id === null) {
        const index = this.news.images.findIndex(x => x.name === image.name);
        this.news.images[index].coords = image.coords;
      } 
      else {
        let uri = `/api/home/news/image/coords/${image.id}`;
        this.axios.post(uri, image).then(response => {
          this.$notify({ type: "success", text: "Änderungen gespeichert!" });
        });
      }
    },

    fixUri(language) {
      let index = 0, pattern = /^((http|https|ftp):\/\/)/;

      if (language == 'de') {
        if (this.news.link.de.length < 1) {
          this.news.link.de = null;
          this.linkPreviewDe = null;
          return;
        }

        if ((index = this.news.link.de.indexOf("@")) !== -1) {
          this.linkPreviewDe = "mailto:" + this.news.link.de;
        } 
        else {
          if (!pattern.test(this.news.link.de)) {
            this.linkPreviewDe = "http://" + this.news.link.de;
            this.news.link.de = "http://" + this.news.link.de;
          } 
          else {
            this.linkPreviewDe = this.news.link.de;
            this.news.link.de = this.news.link.de;
          }
        }
      }

      if (language == 'en') {
        if (this.news.link.en.length < 1) {
          this.news.link.en = null;
          this.linkPreviewEn = null;
          return;
        }

        if ((index = this.news.link.en.indexOf("@")) !== -1) {
          this.linkPreviewEn = "mailto:" + this.news.link.en;
        } 
        else {
          if (!pattern.test(this.news.link.en)) {
            this.linkPreviewEn = "http://" + this.news.link.en;
            this.news.link.en = "http://" + this.news.link.en;
          } 
          else {
            this.linkPreviewEn = this.news.link.en;
            this.news.link.en = this.news.link.en;
          }
        }        
      }
    }

  },

  computed: {
    title: function() {
      return this.$props.type == "edit"
        ? "News bearbeiten"
        : "News hinzufügen";
    }
  }
};
</script>