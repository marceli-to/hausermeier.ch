<template>
  <div>
    <div>
      <h3>Projekte</h3>
      <div class="select-wrapper">
        <select v-model="selectedProject" name="project_id">
          <option selected="selected">Projekt wählen...</option>
          <option v-for="p in filteredProjects" :key="p.id" :value="p.id">{{ p.name.de }}, {{ p.location.de }}</option>
        </select>
      </div>
      <div v-for="project in filteredProjects" :key="project.id">
        <div v-if="selectedProject == project.id">
          <div class="grid-image-selector">
            <div class="grid-image-selector__item">
              <div class="grid-image-selector__media" v-if="project.images.length > 0">
                <figure v-for="image in project.images" :key="image.id">
                  <a href @click.prevent="storeMedia(image.id, 'project')">
                    <img :src="getSource(image.name, 'project-tiny')" height="120" width="70">
                    <span>{{image.name}}</span>
                  </a>
                </figure>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br><br>

      <h3>Strategie &amp; Entwicklung</h3>
      <div class="select-wrapper">
        <select v-model="selectedStrategyProject" name="project_id">
          <option selected="selected">Projekt wählen...</option>
          <option v-for="p in filteredStrategyProjects" :key="'s' + p.id" :value="p.id">{{ p.title.de }}</option>
        </select>
      </div>
      <div v-for="project in filteredStrategyProjects" :key="'s' + project.id">
        <div v-if="selectedStrategyProject == project.id">
          <div class="grid-image-selector">
            <div class="grid-image-selector__item">
              <div class="grid-image-selector__media" v-if="project.images.length > 0">
                <figure v-for="image in project.images" :key="'s' + image.id">
                  <a href @click.prevent="storeMedia(image.id, 'strategy')">
                    <img :src="getSource(image.name, 'project-tiny')" height="120" width="70">
                    <span>{{image.name}}</span>
                  </a>
                </figure>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br><br>

      <h3>Interaktion</h3>
      <div class="select-wrapper">
        <select v-model="selectedInteractionProject" name="project_id">
          <option selected="selected">Projekt wählen...</option>
          <option v-for="p in filteredInteractionProjects" :key="'i' + p.id" :value="p.id">{{ p.title.de }}</option>
        </select>
      </div>
      <div v-for="project in filteredInteractionProjects" :key="'i' + project.id">
        <div v-if="selectedInteractionProject == project.id">
          <div class="grid-image-selector">
            <div class="grid-image-selector__item">
              <div class="grid-image-selector__media" v-if="project.images.length > 0">
                <figure v-for="image in project.images" :key="'i' + image.id">
                  <a href @click.prevent="storeMedia(image.id, 'interaction')">
                    <img :src="getSource(image.name, 'project-tiny')" height="120" width="70">
                    <span>{{image.name}}</span>
                  </a>
                </figure>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br><br><br>

      <h3>Aktuell</h3>
      <div class="select-wrapper">
        <select v-model="selectedDiscourse" name="discourse_id">
          <option selected="selected">Projekt wählen...</option>
          <option v-for="p in filteredDiscourse" :key="'d' + p.id" :value="p.id">{{ p.title.de }}</option>
        </select>
      </div>
      <div v-for="project in filteredDiscourse" :key="'d' + project.id">
        <div v-if="selectedDiscourse == project.id">
          <div class="grid-image-selector">
            <div class="grid-image-selector__item">
              <div class="grid-image-selector__media" v-if="project.images.length > 0">
                <figure v-for="image in project.images" :key="'d' + image.id">
                  <a href @click.prevent="storeMedia(image.id, 'discourse')">
                    <img :src="getSource(image.name, 'project-tiny')" height="120" width="70">
                    <span>{{image.name}}</span>
                  </a>
                </figure>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </div>
  </div>
</template>
<script>
import Utils from "@/mixins/utils";

export default {
  
  data() {
    return {
      search: '',
      selectedProject: null,
      selectedStrategyProject: null,
      selectedInteractionProject: null,
      selectedDiscourse: null,
    };
  },

  props: {
    projects: Array,
    strategyProjects: Array,
    interactionProjects: Array,
    discourse: Array,
  },

  mixins: [Utils],

  mounted() {
  },

  methods: {
    storeMedia(imageId, type) {
      this.$parent.storeMedia(imageId, type);
    },
  },
  
  computed: {
    filteredProjects() {
      let projects = this.$props.projects;
      if (projects) {
        return projects.filter(project => {
          let images = project.images;
          if (images.length > 0) {
            return project;
          }
        })
      }
    },

    filteredStrategyProjects() {
      let strategyProjects = this.$props.strategyProjects;
      if (strategyProjects) {
        return strategyProjects.filter(project => {
          let images = project.images;
          if (images.length > 0) {
            return project;
          }
        })
      }
    },

    filteredInteractionProjects() {
      let interactionProjects = this.$props.interactionProjects;
      if (interactionProjects) {
        return interactionProjects.filter(project => {
          let images = project.images;
          if (images.length > 0) {
            return project;
          }
        })
      }
    },

    filteredDiscourse() {
      let discourse = this.$props.discourse;
      if (discourse) {
        return discourse.filter(project => {
          let images = project.images;
          if (images.length > 0) {
            return project;
          }
        })
      }
    },

  }
};
</script>
<style>
h3 {
  margin-bottom: 5px;
}

.select-wrapper {
  width: 480px;
}
</style>
