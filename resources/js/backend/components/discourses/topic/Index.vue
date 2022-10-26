<template>
  <div>
    <page-header/>
    <notifications classes="notification"/>
    <div class="container">
      <main class="content" role="main">
        <div>
          <h1>Aktuell – Kategorien</h1>
          <router-link :to="{ name: 'discourse-topic-create' }" class="btn-add">
            <span>Hinzufügen</span>
          </router-link>
          <div class="list-items" v-if="topics">
            <div
              :class="[p.publish == 0 ? 'is-disabled' : '', 'list-item']"
              v-for="p in topics"
              :key="p.id"
              data-icons="3"
            >
              <div class="list-item-body">
                {{ p.title.de }}
              </div>
              <div class="list-item-action" data-icons="3">
                <a
                  href="javascript:;"
                  :class="[p.publish == 1 ? 'icon-eye' : 'icon-eye-off', 'icon-mini']"
                  @click.prevent="toggle(p.id,$event)"
                ></a>
                <router-link
                  :to="{name: 'discourse-topic-edit', params: { id: p.id }}"
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
            <p>Es sind noch keine Inhalte vorhanden...</p>
          </div>
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
    PageHeader,
  },

  mixins: [Progress],

  data() {
    return {
      topics: [],
    };
  },

  created() {
    this.fetch();
  },

  methods: {

    fetch() {
      this.axios.get(`/api/discourse/topic/get`).then(response => {
        this.topics = response.data;
      });
    },

    destroy(id,event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let el = this.progress(event.target);
        this.axios.delete(`/api/discourse/topic/destroy/${id}`).then(response => {
          this.fetch();
          this.$notify({ type: "success", text: "Eintrag gelöscht" });
          this.progress(el);
        });
      }
    },

    toggle(id, event) {
      let el = this.progress(event.target);
      this.axios.get(`/api/discourse/topic/status/${id}`).then(response => {
        const index = this.topics.findIndex(x => x.id === id);
        this.topics[index].publish = response.data;
        this.$notify({ type: "success", text: "Status geändert" });
        this.progress(el);
      });
    }
  },

};
</script>