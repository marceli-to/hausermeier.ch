import store from "@/store";
import GridMediaSelector from '@/components/home/grid/MediaSelector.vue';
import GridArticleSelector from '@/components/home/grid/ArticleSelector.vue';

export default {

  components: {
    GridMediaSelector: GridMediaSelector,
    GridArticleSelector: GridArticleSelector,
  },

  data() {
    return {
      
      // grid data
      elements: [],
      projects: [],
      strategyProjects: [],
      interactionProjects: [],
      discourse: [],
      news: [],

      // overlay
      hasOverlayEdit: false,
      showMedia: false,
      showNews: false,

      // temp. data
      tmpGridId: 0,
      tmpPosition: 0,

      selector: '',
    }
  },

  methods: {

    createArticle(gridId, position) {
      this.axios.get('/api/home/news/get/published').then(response => {
        this.news = response.data.data;
        this.toggleOverlay();
        this.showNews = true;
        this.selector = 'GridArticleSelector';
        this.tmpGridId = gridId;
        this.tmpPosition = position;
      });
    },

    createMedia(gridId, position) {

      this.axios.all([
        this.axios.get(`/api/projects/get`),
        this.axios.get(`/api/strategy/projects/get`),
        this.axios.get(`/api/interaction/projects/get`),
        this.axios.get(`/api/discourses/get`),
      ])
      .then(responseArr => {
        this.projects = responseArr[0].data.data;
        this.strategyProjects = responseArr[1].data;
        this.interactionProjects = responseArr[2].data;
        this.discourse = responseArr[3].data;
        this.toggleOverlay();
        this.showMedia = true;
        this.selector = 'GridMediaSelector';
        this.tmpGridId = gridId;
        this.tmpPosition = position;
      });
    },

    storeArticle(newsId) {
      let uri = '/api/home/grid/element/store';
      let data = {
        'grid_id': this.tmpGridId,
        'position': this.tmpPosition,
        'news_id': newsId
      };
      this.axios.post(uri, data).then((response) => {
        this.toggleOverlay();
        this.$notify({type: 'success', text: 'Element hinzugefügt!' });
        this.fetchElements();
        store.commit('gridChanged');
      });
    },

    storeMedia(imageId, type) {
      let uri = '/api/home/grid/element/store';

      let data = {
        'grid_id': this.tmpGridId,
        'position': this.tmpPosition,
      };

      switch(type) {
        case 'project':
          data.project_image_id = imageId;
          data.strategy_project_image_id = null;
          data.interaction_project_image_id = null;
          data.discourse_image_id = null;
        break;

        case 'strategy':
          data.project_image_id = null;
          data.strategy_project_image_id = imageId;
          data.interaction_project_image_id = null;
          data.discourse_image_id = null;
        break;

        case 'interaction':
          data.project_image_id = null;
          data.strategy_project_image_id = null;
          data.interaction_project_image_id = imageId;
          data.discourse_image_id = null;
        break;

        case 'discourse':
          data.project_image_id = null;
          data.strategy_project_image_id = null;
          data.interaction_project_image_id = null;
          data.discourse_image_id = imageId;
        break;
      }

      this.axios.post(uri, data).then((response) => {
        this.toggleOverlay();
        this.$notify({type: 'success', text: 'Bild hinzugefügt!'});
        this.fetchElements();
        store.commit('gridChanged');
      });
    },

    deleteArticle(gridElementId, event) {
      let btn = event.target;
      btn.classList.add('is-loading');
      let uri = `/api/home/grid/element/delete/${gridElementId}`;
      this.axios.delete(uri).then(response => {
        btn.classList.remove('is-loading');
        this.$notify({type: 'success', text: 'News gelöscht!'});
        this.fetchElements();
        store.commit('gridChanged');
      });
    },

    deleteMedia(gridElementId,event) {
      let btn = event.target;
      btn.classList.add('is-loading');
      let uri = `/api/home/grid/element/delete/${gridElementId}`;
      this.axios.delete(uri).then(response => {
        btn.classList.remove('is-loading');
        this.$notify({type: 'success', text: 'Bild gelöscht!'});
        this.fetchElements();
        store.commit('gridChanged');
      });
    },
    
    toggleOverlay() {
      this.hasOverlayEdit = this.hasOverlayEdit ? false : true;
      if (!this.hasOverlayEdit) {
        this.showNews = false;
        this.showMedia = false;
      }
    },
  }
};