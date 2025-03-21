<template>
  <div>
    <page-header/>
    <notifications classes="notification"/>
    <div class="container">
      <main class="content" role="main">
        <div>
          <h1>Profil - Bilder</h1>
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
              :imagePreviewRoute="'profile'"
              :aspectRatioW="16"
              :aspectRatioH="6"
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
    ImageEdit
  },

  mixins: [Utils, Progress],

  data() {
    return {
      images: [],
    };
  },

  created() {
    this.fetch();
  },

  methods: {
    fetch() {
      let uri = "/api/profile/images/get";
      this.axios.get(uri).then(response => {
        this.images = response.data.data;
      });
    },

    // Upload callback
    uploadComplete(image) {
      this.storeImage(image);
    },

    // Save image
    storeImage(image) {
      let uri = "/api/profile/image/create";
      let data = {
        name: image.name,
        caption: {
          de: null,
          en: null,
        },
        coords: null,
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
        let uri = `/api/profile/image/destroy/${image}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          const index = this.images.findIndex(x => x.name === image);
          this.images.splice(index, 1);
          this.progress(el);
        });
      }
    },

    toggleImage(image, event) {
      let uri = `/api/profile/image/status/${image.id}`;
      let el = this.progress(event.target);
      this.axios.get(uri).then(response => {
        const index = this.images.findIndex(x => x.id === image.id);
        this.images[index].publish = response.data;
        this.progress(el);
      });
    },

    updateImage(image, event) {
      let uri = `/api/profile/image/update/${image.id}`;
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
        let uri = `/api/profile/image/coords/${image.id}`;
        this.axios.post(uri, image).then(response => {
          this.$notify({ type: "success", text: "Änderungen gespeichert!" });
        });
      }
    },
  },
};
</script>