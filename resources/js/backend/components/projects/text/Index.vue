<template>
  <div>
    <page-header/>
    <notifications classes="notification"/>
    <div class="container">
      <main class="content" role="main">
        <div>
          <h1>Projekttexte</h1>
          <router-link :to="{ name: 'project-text-create' }" class="btn-add">
            <span>Hinzufügen</span>
          </router-link>
          <div class="list-items" v-if="projectText.length">
            <div
              :class="[p.publish == 0 ? 'is-disabled' : '', 'list-item']"
              v-for="p in projectText"
              :key="p.id"
              data-icons="3"
            >
              <div class="list-item-body">
                <div v-html="p.text.de">{{ p.text.de }}</div>
              </div>
              <div class="list-item-action" data-icons="3">
                <a
                  href="javascript:;"
                  :class="[p.publish == 1 ? 'icon-eye' : 'icon-eye-off', 'icon-mini']"
                  @click.prevent="toggleStatus(p.id,$event)"
                ></a>
                <router-link
                  :to="{name: 'project-text-edit', params: { id: p.id }}"
                  class="icon-edit icon-mini"
                ></router-link>
                <a
                  href="javascript:;"
                  class="icon-trash icon-mini"
                  @click.prevent="destroy(p.id,$event)"
                ></a>
              </div>
            </div>
          </div>
          <div v-else>
            <p>Es sind noch keine Projektexte vorhanden...</p>
          </div>
          <footer class="site-footer">
            <div>
              <router-link :to="{name: 'projects'}">Zurück</router-link>
            </div>
          </footer>
        </div>
      </main>
    </div>
  </div>
</template>
<script>
import PageHeader from "@/layout/PageHeader.vue";
import Progress from "@/mixins/progress";

export default {
  components: {
    PageHeader: PageHeader
  },

  mixins: [Progress],

  data() {
    return {
      projectText: [],
    };
  },

  created() {
    this.fetch();
  },

  methods: {
    fetch() {
      let uri = `/api/project/text/get/${this.$route.params.id}`;
      this.axios.get(uri).then(response => {
        this.projectText = response.data.data;
      });
    },

    destroy(id,event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/project/text/destroy/${id}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          this.fetch();
          this.$notify({ type: "success", text: "Eintrag gelöscht" });
          this.progress(el);
        });
      }
    },

    toggleStatus(id,event) {
      let uri = `/api/project/text/status/${id}`;
      let el = this.progress(event.target);
      this.axios.get(uri).then(response => {
        const index = this.projectText.findIndex(x => x.id === id);
        this.projectText[index].publish = response.data;
        this.$notify({ type: "success", text: "Status geändert" });
        this.progress(el)
      });
    },
  },
};
</script>