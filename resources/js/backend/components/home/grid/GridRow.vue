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
              <div v-if="elements[1].isMedia">
                <grid-media :element="elements[1]"></grid-media>
              </div>
              <div v-if="elements[1].isArticle">
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
              <div v-if="elements[0].isMedia">
                <grid-media :element="elements[0]"></grid-media>
              </div>
              <div v-if="elements[0].isArticle">
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
              <div v-if="elements[0].isMedia">
                <grid-media :element="elements[0]"></grid-media>
              </div>
              <div v-if="elements[0].isArticle">
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
              <div v-if="elements[1].isMedia">
                <grid-media :element="elements[1]"></grid-media>
              </div>
              <div v-if="elements[1].isArticle">
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
              <div v-if="elements[2].isMedia">
                <grid-media :element="elements[2]"></grid-media>
              </div>
              <div v-if="elements[2].isArticle">
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
              <div v-if="elements[0].isMedia">
                <grid-media :element="elements[0]"></grid-media>
              </div>
              <div v-if="elements[0].isArticle">
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
              <div v-if="elements[1].isMedia">
                <grid-media :element="elements[1]"></grid-media>
              </div>
              <div v-if="elements[1].isArticle">
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
              <div v-if="elements[2].isMedia">
                <grid-media :element="elements[2]"></grid-media>
              </div>
              <div v-if="elements[2].isArticle">
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
                <div v-if="elements[0].isMedia">
                  <grid-media :element="elements[0]"></grid-media>
                </div>
                <div v-if="elements[0].isArticle">
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
                <div v-if="elements[1].isMedia">
                  <grid-media :element="elements[1]"></grid-media>
                </div>
                <div v-if="elements[1].isArticle">
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
                <div v-if="elements[1].isMedia">
                  <grid-media :element="elements[1]"></grid-media>
                </div>
                <div v-if="elements[1].isArticle">
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
                <div v-if="elements[2].isMedia">
                  <grid-media :element="elements[2]"></grid-media>
                </div>
                <div v-if="elements[2].isArticle">
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
                <div v-if="elements[0].isMedia">
                  <grid-media :element="elements[0]"></grid-media>
                </div>
                <div v-if="elements[0].isArticle">
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
                <div v-if="elements[1].isMedia">
                  <grid-media :element="elements[1]"></grid-media>
                </div>
                <div v-if="elements[1].isArticle">
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
              <div v-if="elements[2].isMedia">
                <grid-media :element="elements[2]"></grid-media>
              </div>
              <div v-if="elements[2].isArticle">
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
              <div v-if="elements[3].isMedia">
                <grid-media :element="elements[3]"></grid-media>
              </div>
              <div v-if="elements[3].isArticle">
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
              <div v-if="elements[0].isMedia">
                <grid-media :element="elements[0]"></grid-media>
              </div>
              <div v-if="elements[0].isArticle">
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
                <div v-if="elements[1].isMedia">
                  <grid-media :element="elements[1]"></grid-media>
                </div>
                <div v-if="elements[1].isArticle">
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
                <div v-if="elements[2].isMedia">
                  <grid-media :element="elements[2]"></grid-media>
                </div>
                <div v-if="elements[2].isArticle">
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
              <div v-if="elements[3].isMedia">
                <grid-media :element="elements[3]"></grid-media>
              </div>
              <div v-if="elements[3].isArticle">
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
              <div v-if="elements[0].isMedia">
                <grid-media :element="elements[0]"></grid-media>
              </div>
              <div v-if="elements[0].isArticle">
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
              <div v-if="elements[1].isMedia">
                <grid-media :element="elements[1]"></grid-media>
              </div>
              <div v-if="elements[1].isArticle">
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
                <div v-if="elements[2].isMedia">
                  <grid-media :element="elements[2]"></grid-media>
                </div>
                <div v-if="elements[2].isArticle">
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
                <div v-if="elements[3].isMedia">
                  <grid-media :element="elements[3]"></grid-media>
                </div>
                <div v-if="elements[3].isArticle">
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
          <grid-media-selector :projects="projects" :strategyProjects="strategyProjects" :interactionProjects="interactionProjects" :discourse="discourse" v-bind:is="selector"></grid-media-selector>
        </div>
        <div v-show="showNews">
          <grid-article-selector :news="news" v-bind:is="selector"></grid-article-selector>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import GridMedia from "@/components/home/grid/Media.vue";
import GridArticle from "@/components/home/grid/Article.vue";
import ButtonMedia from "@/components/home/grid/buttons/Media.vue";
import ButtonArticle from "@/components/home/grid/buttons/Article.vue";
import Utils from "@/mixins/utils";
import Grid from "@/components/home/grid/mixins/grid";

export default {
  components: {
    GridMedia,
    GridArticle,
    ButtonMedia,
    ButtonArticle,
  },

  props: {
    layout: String,
    gridId: Number
  },

  mixins: [Utils, Grid],

  created() {
    this.fetchElements();
  },

  methods: {
    fetchElements() {
      let uri = `/api/home/grid/elements/${this.$props.gridId}`;
      this.axios.get(uri).then(response => {
        let els = [];
        if (response.data.data) {
          response.data.data.forEach(e => {

            if (e.project_image_id) {
              let img = e.image;
              let el = {
                id: e.id,
                position: e.position,
                newsId: null,
                image: img.name || null,
                imageId: img.id,
                caption: `${img.caption.de}` || null,
                isArticle: 0,
                isMedia: 1,
              };
              els[e.position] = el;
            }

            if (e.strategy_project_image_id) {
              let img = e.strategy_image;
              let el = {
                id: e.id,
                position: e.position,
                newsId: null,
                image: img.name || null,
                imageId: img.id,
                caption: `${img.caption.de}` || null,
                isArticle: 0,
                isMedia: 1,
              };
              els[e.position] = el;
            }

            if (e.interaction_project_image_id) {
              let img = e.interaction_image;
              let el = {
                id: e.id,
                position: e.position,
                newsId: null,
                image: img.name || null,
                imageId: img.id,
                caption: `${img.caption.de}` || null,
                isArticle: 0,
                isMedia: 1,
              };
              els[e.position] = el;
            }

            if (e.discourse_image_id) {
              let img = e.discourse_image;
              let el = {
                id: e.id,
                position: e.position,
                newsId: null,
                image: img.name || null,
                imageId: img.id,
                caption: `${img.caption.de}` || null,
                isArticle: 0,
                isMedia: 1,
              };
              els[e.position] = el;
            }

            if (e.news_id) {
              let el = {
                id: e.id,
                position: e.position,
                layout: e.news.layout,
                date: e.news.date.de,
                title: e.news.title.de,
                description: e.news.description.de,
                newsId: e.news_id,
                isArticle: 1,
                isMedia: 0,
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
  }
};
</script>