<template>
  <div>
    <page-header/>
    <notifications classes="notification"/>
    <div class="container">
      <main class="content" role="main">
        <div>
          <h1>Team - Bilder</h1>
          <div class="form-row">
            <image-upload
              :restrictions="'jpg, png | max. 8 MB'"
              :maxFiles="99"
              :maxFilesize="8"
              :acceptedFiles="'.png,.jpg'"
            ></image-upload>
          </div>
          <div class="form-row" v-if="images.length">
            <image-edit 
              :images="images"
              :updateOnChange="true"
              :categories="categories"
              :imagePreviewRoute="'team'"
              :aspectRatioW="4"
              :aspectRatioH="3"
            ></image-edit>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>
<script>
// Layout
import PageHeader from "@/layout/PageHeader.vue";

// Upload
import ImageUpload from "@/components/global/images/Upload.vue";
import ImageEdit from "@/components/global/images/Edit.vue";

// Mixins
import Utils from "@/mixins/utils";
import Progress from "@/mixins/progress";

export default {
  components: {
    PageHeader,
    ImageUpload,
    ImageEdit,
  },

  mixins: [Utils, Progress],

  data() {
    return {
      images: [],
      categories: {},
    };
  },

  created() {
    this.fetch();
  },

  methods: {
    fetch() {
      let uri = "/api/team/images/get";
      this.axios.get(uri).then(response => {
        this.images = response.data.data;
      });

      this.axios.get(`/api/settings/teamCategories`).then(response => {
        this.categories = response.data;
      });
    },

    // Upload callback
    uploadComplete(image) {
      this.storeImage(image);
    },

    // Save image
    storeImage(image) {
      let uri = "/api/team/image/create";
      let data = {
        name: image.name,
        caption: {
          de: null,
          en: null,
        },
        publish: 0
      };

      this.axios.post(uri, data).then(response => {
        data.id = response.data.imageId;
        this.images.push(data);
        this.$notify({ type: "success", text: "Bild gespeichert!" });
      });
    },

    destroyImage(image, event) {
      if (confirm("Please confirm!")) {
        let uri = `/api/team/image/destroy/${image}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          const index = this.images.findIndex(x => x.name === image);
          this.images.splice(index, 1);
          this.progress(el);
        });
      }
    },

    toggleImage(image, event) {
      let uri = `/api/team/image/status/${image.id}`;
      let el = this.progress(event.target);
      this.axios.get(uri).then(response => {
        const index = this.images.findIndex(x => x.id === image.id);
        this.images[index].publish = response.data;
        this.progress(el);
      });
    },

    updateImage(image, event) {
      let uri = `/api/team/image/update/${image.id}`;
      this.axios.post(uri, image).then(response => {
        this.$notify({ type: "success", text: "Änderungen gespeichert!" });
      });
    },

    saveImageCoords(image) {
      if (image.id === null) {
        const index = this.images.findIndex(x => x.name === image.name);
        this.images[index].coords = image.coords;
      } 
      else {
        let uri = `/api/team/image/coords/${image.id}`;
        this.axios.post(uri, image).then(response => {
          this.$notify({ type: "success", text: "Änderungen gespeichert!" });
        });
      }
    },
   },
};
</script>