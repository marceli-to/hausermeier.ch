<template>
  <div>
    <page-header/>
    <notifications classes="notification"/>
    <div class="container">
      <main class="content" role="main">
        <div>
          <h1>Home - News</h1>
          <router-link :to="{ name: 'home-news-create' }" class="btn-add">
            <span>Hinzufügen</span>
          </router-link>
          <div class="list-items" v-if="news.length">
            <div
              :class="[n.publish == 0 ? 'is-disabled' : '', 'list-item']"
              v-for="n in news"
              :key="n.id"
              data-icons="3"
            >
              <div class="list-item-body">
                <em v-if="n.date.de">{{n.date.de}} –</em> 
                <em v-if="n.title.de">{{n.title.de}}</em>
                <em v-if="n.description.de && !n.title.de && !n.date.de" :inner-html.prop="n.description.de | truncate(75, '...')"></em>
              </div>
              <div class="list-item-action" data-icons="3">
                <a
                  href="javascript:;"
                  :class="[n.publish == 1 ? 'icon-eye' : 'icon-eye-off', 'icon-mini']"
                  @click.prevent="toggleStatus(n.id,$event)"
                ></a>
                <router-link
                  :to="{name: 'home-news-edit', params: { id: n.id }}"
                  class="icon-edit icon-mini"
                ></router-link>
                <a
                  href="javascript:;"
                  class="icon-trash icon-mini"
                  @click.prevent="destroy(n.id,$event)"
                ></a>
              </div>
            </div>
          </div>
          <div v-else>
            <p>Es sind noch keine News vorhanden...</p>
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
    PageHeader: PageHeader
  },

  mixins: [Progress],

  data() {
    return {
      news: [],
    };
  },

  created() {
    this.fetch();
  },

  methods: {
    fetch() {
      let uri = "/api/home/news/get";
      this.axios.get(uri).then(response => {
        this.news = response.data.data;
      });
    },

    destroy(id,event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/home/news/destroy/${id}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          this.fetch();
          this.$notify({ type: "success", text: "Eintrag gelöscht" });
          this.progress(el);
        });
      }
    },

    toggleStatus(id,event) {
      let uri = `/api/home/news/status/${id}`;
      let el = this.progress(event.target);
      this.axios.get(uri).then(response => {
        const index = this.news.findIndex(x => x.id === id);
        this.news[index].publish = response.data;
        this.$notify({ type: "success", text: "Status geändert" });
        this.progress(el)
      });
    },
  },
};
</script>