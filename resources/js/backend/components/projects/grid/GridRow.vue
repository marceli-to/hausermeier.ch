<template>
  <div>
    <div class="ratio-boxes">
      <div v-if="layout == '1'">
        <div class="box-1">
          <div class="box__e">
            <div v-if="elements[0] && elements[0].position == '0'">
              <grid-media :element="elements[0]"></grid-media>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="0"></button-media>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="layout == '1-1'">
        <div class="box-1-1">
          <div class="box__c">
            <div v-if="elements[0] && elements[0].position == '0'">
              <grid-media :element="elements[0]"></grid-media>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="0"></button-media>
              </div>
            </div>
          </div>
          <div class="box__c">
            <div v-if="elements[1] && elements[1].position == '1'">
              <grid-media :element="elements[1]"></grid-media>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="1"></button-media>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="layout == '2-1'">
        <div class="box-2-1">
          <div class="box__b">
            <div v-if="elements[0] && elements[0].position == '0'">
              <grid-media :element="elements[0]"></grid-media>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="0"></button-media>
              </div>
            </div>
          </div>
          <div class="box__a">
            <div v-if="elements[1] && elements[1].position == '1'">
              <div v-if="elements[1].isImage">
                <grid-media :element="elements[1]"></grid-media>
              </div>
              <div v-if="elements[1].isText">
                <grid-article :element="elements[1]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="1"></button-media>
                <button-article :gridId="gridId" :gridPosition="1"></button-article>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="layout == '1-2'">
        <div class="box-1-2">
          <div class="box__a">
            <div v-if="elements[0] && elements[0].position == '0'">
              <div v-if="elements[0].isImage">
                <grid-media :element="elements[0]"></grid-media>
              </div>
              <div v-if="elements[0].isText">
                <grid-article :element="elements[0]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="0"></button-media>
                <button-article :gridId="gridId" :gridPosition="0"></button-article>
              </div>
            </div>
          </div>
          <div class="box__b">
            <div v-if="elements[1] && elements[1].position == '1'">
              <grid-media :element="elements[1]"></grid-media>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="1"></button-media>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="layout == '1p-1p-1p'">
        <div class="box-1-1-1">
          <div class="box__a">
            <div v-if="elements[0] && elements[0].position == '0'">
              <div v-if="elements[0].isImage">
                <grid-media :element="elements[0]"></grid-media>
              </div>
              <div v-if="elements[0].isText">
                <grid-article :element="elements[0]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="0"></button-media>
                <button-article :gridId="gridId" :gridPosition="0"></button-article>
              </div>
            </div>
          </div>
          <div class="box__a">
            <div v-if="elements[1] && elements[1].position == '1'">
              <div v-if="elements[1].isImage">
                <grid-media :element="elements[1]"></grid-media>
              </div>
              <div v-if="elements[1].isText">
                <grid-article :element="elements[1]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="1"></button-media>
                <button-article :gridId="gridId" :gridPosition="1"></button-article>
              </div>
            </div>
          </div>
          <div class="box__a">
            <div v-if="elements[2] && elements[2].position == '2'">
              <div v-if="elements[2].isImage">
                <grid-media :element="elements[2]"></grid-media>
              </div>
              <div v-if="elements[2].isText">
                <grid-article :element="elements[2]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="2"></button-media>
                <button-article :gridId="gridId" :gridPosition="2"></button-article>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="layout == '1-1-1'">
        <div class="box-1-1-1">
          <div class="box__d">
            <div v-if="elements[0] && elements[0].position == '0'">
              <div v-if="elements[0].isImage">
                <grid-media :element="elements[0]"></grid-media>
              </div>
              <div v-if="elements[0].isText">
                <grid-article :element="elements[0]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="0"></button-media>
                <button-article :gridId="gridId" :gridPosition="0"></button-article>
              </div>
            </div>
          </div>
          <div class="box__d">
            <div v-if="elements[1] && elements[1].position == '1'">
              <div v-if="elements[1].isImage">
                <grid-media :element="elements[1]"></grid-media>
              </div>
              <div v-if="elements[1].isText">
                <grid-article :element="elements[1]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="1"></button-media>
                <button-article :gridId="gridId" :gridPosition="1"></button-article>
              </div>
            </div>
          </div>
          <div class="box__d">
            <div v-if="elements[2] && elements[2].position == '2'">
              <div v-if="elements[2].isImage">
                <grid-media :element="elements[2]"></grid-media>
              </div>
              <div v-if="elements[2].isText">
                <grid-article :element="elements[2]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="2"></button-media>
                <button-article :gridId="gridId" :gridPosition="2"></button-article>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="layout == '2s-1'">
        <div class="box-1-2">
          <div>
            <div class="box__d">
              <div v-if="elements[0] && elements[0].position == '0'">
                <div v-if="elements[0].isImage">
                  <grid-media :element="elements[0]"></grid-media>
                </div>
                <div v-if="elements[0].isText">
                  <grid-article :element="elements[0]"></grid-article>
                </div>
              </div>
              <div v-else>
                <div class="box-buttons">
                  <button-media :gridId="gridId" :gridPosition="0"></button-media>
                  <button-article :gridId="gridId" :gridPosition="0"></button-article>
                </div>
              </div>
            </div>
            <div class="box__d">
              <div v-if="elements[1] && elements[1].position == '1'">
                <div v-if="elements[1].isImage">
                  <grid-media :element="elements[1]"></grid-media>
                </div>
                <div v-if="elements[1].isText">
                  <grid-article :element="elements[1]"></grid-article>
                </div>
              </div>
              <div v-else>
                <div class="box-buttons">
                  <button-media :gridId="gridId" :gridPosition="1"></button-media>
                  <button-article :gridId="gridId" :gridPosition="1"></button-article>
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="box__b">
              <div v-if="elements[2] && elements[2].position == '2'">
                <grid-media :element="elements[2]"></grid-media>
              </div>
              <div v-else>
                <div class="box-buttons">
                  <button-media :gridId="gridId" :gridPosition="2"></button-media>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="layout == '1-2s'">
        <div class="box-2-1">
          <div>
            <div class="box__b">
              <div v-if="elements[0] && elements[0].position == '0'">
                <grid-media :element="elements[0]"></grid-media>
              </div>
              <div v-else>
                <div class="box-buttons">
                  <button-media :gridId="gridId" :gridPosition="0"></button-media>
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="box__d">
              <div v-if="elements[1] && elements[1].position == '1'">
                <div v-if="elements[1].isImage">
                  <grid-media :element="elements[1]"></grid-media>
                </div>
                <div v-if="elements[1].isText">
                  <grid-article :element="elements[1]"></grid-article>
                </div>
              </div>
              <div v-else>
                <div class="box-buttons">
                  <button-media :gridId="gridId" :gridPosition="1"></button-media>
                  <button-article :gridId="gridId" :gridPosition="1"></button-article>
                </div>
              </div>
            </div>
            <div class="box__d">
              <div v-if="elements[2] && elements[2].position == '2'">
                <div v-if="elements[2].isImage">
                  <grid-media :element="elements[2]"></grid-media>
                </div>
                <div v-if="elements[2].isText">
                  <grid-article :element="elements[2]"></grid-article>
                </div>
              </div>
              <div v-else>
                <div class="box-buttons">
                  <button-media :gridId="gridId" :gridPosition="2"></button-media>
                  <button-article :gridId="gridId" :gridPosition="2"></button-article>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <div v-if="layout == '2s-1-1'">
        <div class="box-1-1-1">
          <div>
            <div class="box__d">
              <div v-if="elements[0] && elements[0].position == '0'">
                <div v-if="elements[0].isImage">
                  <grid-media :element="elements[0]"></grid-media>
                </div>
                <div v-if="elements[0].isText">
                  <grid-article :element="elements[0]"></grid-article>
                </div>
              </div>
              <div v-else>
                <div class="box-buttons">
                  <button-media :gridId="gridId" :gridPosition="0"></button-media>
                  <button-article :gridId="gridId" :gridPosition="0"></button-article>
                </div>
              </div>
            </div>
            <div class="box__d">
              <div v-if="elements[1] && elements[1].position == '1'">
                <div v-if="elements[1].isImage">
                  <grid-media :element="elements[1]"></grid-media>
                </div>
                <div v-if="elements[1].isText">
                  <grid-article :element="elements[1]"></grid-article>
                </div>
              </div>
              <div v-else>
                <div class="box-buttons">
                  <button-media :gridId="gridId" :gridPosition="1"></button-media>
                  <button-article :gridId="gridId" :gridPosition="1"></button-article>
                </div>
              </div>
            </div>
          </div>
          <div class="box__a">
            <div v-if="elements[2] && elements[2].position == '2'">
              <div v-if="elements[2].isImage">
                <grid-media :element="elements[2]"></grid-media>
              </div>
              <div v-if="elements[2].isText">
                <grid-article :element="elements[2]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="2"></button-media>
                <button-article :gridId="gridId" :gridPosition="2"></button-article>
              </div>
            </div>
          </div>
          <div class="box__a">
            <div v-if="elements[3] && elements[3].position == '3'">
              <div v-if="elements[3].isImage">
                <grid-media :element="elements[3]"></grid-media>
              </div>
              <div v-if="elements[3].isText">
                <grid-article :element="elements[3]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="3"></button-media>
                <button-article :gridId="gridId" :gridPosition="3"></button-article>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="layout == '1-2s-1'">
        <div class="box-1-1-1">
          <div class="box__a">
            <div v-if="elements[0] && elements[0].position == '0'">
              <div v-if="elements[0].isImage">
                <grid-media :element="elements[0]"></grid-media>
              </div>
              <div v-if="elements[0].isText">
                <grid-article :element="elements[0]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="0"></button-media>
                <button-article :gridId="gridId" :gridPosition="0"></button-article>
              </div>
            </div>
          </div>
          <div>
            <div class="box__d">
              <div v-if="elements[1] && elements[1].position == '1'">
                <div v-if="elements[1].isImage">
                  <grid-media :element="elements[1]"></grid-media>
                </div>
                <div v-if="elements[1].isText">
                  <grid-article :element="elements[1]"></grid-article>
                </div>
              </div>
              <div v-else>
                <div class="box-buttons">
                  <button-media :gridId="gridId" :gridPosition="1"></button-media>
                  <button-article :gridId="gridId" :gridPosition="1"></button-article>
                </div>
              </div>
            </div>
            <div class="box__d">
              <div v-if="elements[2] && elements[2].position == '2'">
                <div v-if="elements[2].isImage">
                  <grid-media :element="elements[2]"></grid-media>
                </div>
                <div v-if="elements[2].isText">
                  <grid-article :element="elements[2]"></grid-article>
                </div>
              </div>
              <div v-else>
                <div class="box-buttons">
                  <button-media :gridId="gridId" :gridPosition="2"></button-media>
                  <button-article :gridId="gridId" :gridPosition="2"></button-article>
                </div>
              </div>
            </div>
          </div>
          <div class="box__a">
            <div v-if="elements[3] && elements[3].position == '3'">
              <div v-if="elements[3].isImage">
                <grid-media :element="elements[3]"></grid-media>
              </div>
              <div v-if="elements[3].isText">
                <grid-article :element="elements[3]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="3"></button-media>
                <button-article :gridId="gridId" :gridPosition="3"></button-article>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-if="layout == '1-1-2s'">
        <div class="box-1-1-1">
          <div class="box__a">
            <div v-if="elements[0] && elements[0].position == '0'">
              <div v-if="elements[0].isImage">
                <grid-media :element="elements[0]"></grid-media>
              </div>
              <div v-if="elements[0].isText">
                <grid-article :element="elements[0]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="0"></button-media>
                <button-article :gridId="gridId" :gridPosition="0"></button-article>
              </div>
            </div>
          </div>
          <div class="box__a">
            <div v-if="elements[1] && elements[1].position == '1'">
              <div v-if="elements[1].isImage">
                <grid-media :element="elements[1]"></grid-media>
              </div>
              <div v-if="elements[1].isText">
                <grid-article :element="elements[1]"></grid-article>
              </div>
            </div>
            <div v-else>
              <div class="box-buttons">
                <button-media :gridId="gridId" :gridPosition="1"></button-media>
                <button-article :gridId="gridId" :gridPosition="1"></button-article>
              </div>
            </div>
          </div>
          <div>
            <div class="box__d">
              <div v-if="elements[2] && elements[2].position == '2'">
                <div v-if="elements[2].isImage">
                  <grid-media :element="elements[2]"></grid-media>
                </div>
                <div v-if="elements[2].isText">
                  <grid-article :element="elements[2]"></grid-article>
                </div>
              </div>
              <div v-else>
                <div class="box-buttons">
                  <button-media :gridId="gridId" :gridPosition="2"></button-media>
                  <button-article :gridId="gridId" :gridPosition="2"></button-article>
                </div>
              </div>
            </div>
            <div class="box__d">
              <div v-if="elements[3] && elements[3].position == '3'">
                <div v-if="elements[3].isImage">
                  <grid-media :element="elements[3]"></grid-media>
                </div>
                <div v-if="elements[3].isText">
                  <grid-article :element="elements[3]"></grid-article>
                </div>
              </div>
              <div v-else>
                <div class="box-buttons">
                  <button-media :gridId="gridId" :gridPosition="3"></button-media>
                  <button-article :gridId="gridId" :gridPosition="3"></button-article>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div :class="[hasOverlayEdit ? 'is-visible': '', 'grid-overlay']">
      <div>
        <a href="javascript:;" @click.prevent="toggleOverlay()" class="icon-close-overlay"></a>
        <div v-show="showMedia">
          <grid-media-selector :images="images" v-bind:is="selector"></grid-media-selector>
        </div>
        <div v-show="showText">
          <grid-article-selector :text="text" v-bind:is="selector"></grid-article-selector>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import GridMedia from "@/components/projects/grid/Media.vue";
import GridArticle from "@/components/projects/grid/Article.vue";
import ButtonMedia from "@/components/projects/grid/buttons/Media.vue";
import ButtonArticle from "@/components/projects/grid/buttons/Article.vue";


import GridMediaSelector from '@/components/projects/grid/MediaSelector.vue';
import GridArticleSelector from '@/components/projects/grid/ArticleSelector.vue';

import Utils from "@/mixins/utils";

export default {
  components: {
    GridMedia,
    GridArticle,
    ButtonMedia,
    ButtonArticle,
    GridMediaSelector,
    GridArticleSelector,
  },

  mixins: [Utils],

  data() {
    return {
      hasOverlayEdit: false,
      showMedia: false,
      showText: false,
      tmpGridId: null,
      tmpPosition: null,

      // Project images
      images: [],

      // Project text
      text: [],

      // Grid elements
      elements: [],

      selector: '',
    };
  },

  props: {
    layout: String,
    gridId: Number,
    projectId: Number
  },

  created() {
    this.fetch();
  },

  methods: {
    fetch() {
      let uri = `/api/project/grid/elements/${this.$props.gridId}`;
      this.axios.get(uri).then(response => {
        let els = [];
        if (response.data.data) {
          response.data.data.forEach(e => {
            if (e.project_image_id) {
              let img = e.image;
              let el = {
                id: e.id,
                position: e.position,
                projectId: img.project.id || null,
                textId: null,
                image: img.name || null,
                imageId: img.id,
                caption: `${img.caption.de}` || null,
                isText: 0,
                isImage: 1,
              };
              els[e.position] = el;
            }

            if (e.project_text_id) {
              let el = {
                id: e.id,
                position: e.position,
                projectId: e.text.project.id || null,
                text: e.text.text.de,
                textId: e.text.id,
                imageId: null,
                isText: 1,
                isImage: 0,
              };
              els[e.position] = el;
            }
          });
          if (els.length > 0) {
            this.elements = els;
          } else if (els.length == 0) {
            this.elements = [];
          }
        }
      });
    },

    createText(gridId, position) {
      this.axios.get(`/api/project/text/get/published/${this.$props.projectId}`).then(response => {
        this.text = response.data.data;
        this.toggleOverlay();
        this.showText = true;
        this.selector = 'GridArticleSelector';
        this.tmpGridId = gridId;
        this.tmpPosition = position;
      });
    },

    createMedia(gridId, position) {
      let uri = `/api/project/image/get/${this.$props.projectId}`;
      this.axios.get(uri).then(response => {
        this.images = response.data.data;
        this.toggleOverlay();
        this.showMedia = true;
        this.selector = 'GridMediaSelector';
        this.tmpGridId = gridId;
        this.tmpPosition = position;
      });
    },

    storeMedia(imageId) {
      let data = {
        position: this.tmpPosition,
        grid_id: this.tmpGridId,
        project_image_id: imageId,
        project_id: this.$props.projectId,
        is_text: 0,
        is_image: 1,
      };

      let uri = "/api/project/grid/element/store";
      this.axios.post(uri, data).then(response => {
        this.showMedia = false;
        this.toggleOverlay();
        this.$notify({ type: "success", text: "Bild hinzugefügt" });
        this.fetch();
      });
    },

    storeText(textId) {
      let uri = '/api/project/grid/element/store';
      let data = {
        grid_id: this.tmpGridId,
        position: this.tmpPosition,
        text_id: textId,
        project_id: this.$props.projectId,
        is_text: 1,
        is_image: 0,
      };
      this.axios.post(uri, data).then((response) => {
        this.showText = false;
        this.toggleOverlay();
        this.$notify({type: 'success', text: 'Text hinzugefügt!' });
        this.fetch();
      });
    },

    deleteMedia(id,event) {
      let btn = event.target;
      btn.classList.add('is-loading');
      let uri = `/api/project/grid/element/delete/${id}`;
      this.axios.delete(uri).then(response => {
        btn.classList.remove("is-loading");
        this.$notify({ type: "success", text: "Bild gelöscht" });
        this.fetch();
      });
    },

    deleteText(id, event) {
      let btn = event.target;
      btn.classList.add('is-loading');
      let uri = `/api/project/grid/element/delete/${id}`;
      this.axios.delete(uri).then(response => {
        btn.classList.remove('is-loading');
        this.$notify({type: 'success', text: 'Text gelöscht!'});
        this.fetch();
      });
    },

    toggleOverlay() {
      this.hasOverlayEdit = this.hasOverlayEdit ? false : true;
      if (!this.hasOverlayEdit) {
        this.showText = false;
        this.showMedia = false;
      }
    },
  }
};
</script>