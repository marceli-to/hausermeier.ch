<template>
  <div>
    <page-header/>
    <notifications classes="notification"/>
    <div class="container">
      <main class="content" role="main">
        <div>
          <h1>Strategie &amp; Entwicklung - Intro</h1>
          <router-link :to="{ name: 'strategy-intro-create' }" class="btn-add">
            <span>Hinzufügen</span>
          </router-link>
          <div class="list-items" v-if="intro">
            <div
              :class="[i.publish == 0 ? 'is-disabled' : '', 'list-item']"
              v-for="i in intro"
              :key="i.id"
              data-icons="3"
            >
              <div class="list-item-body">
                {{ i.text_intro.de | truncate(50, '...') }}
              </div>
              <div class="list-item-action" data-icons="3">
                <a
                  href="javascript:;"
                  :class="[i.publish == 1 ? 'icon-eye' : 'icon-eye-off', 'icon-mini']"
                  @click.prevent="toggle(i.id,$event)"
                ></a>
                <router-link
                  :to="{name: 'strategy-intro-edit', params: { id: i.id }}"
                  class="icon-edit icon-mini"
                ></router-link>
                <a
                  href="javascript:;"
                  class="icon-trash icon-mini"
                  @click.prevent="destroy(i.id,$event)"
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
    PageHeader: PageHeader,
  },

  mixins: [Progress],

  data() {
    return {
      intro: [],
    };
  },

  created() {
    this.fetch();
  },

  methods: {

    fetch() {
      this.axios.get(`/api/intro/get/strategy`).then(response => {
        this.intro = response.data;
      });
    },

    destroy(id,event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let el = this.progress(event.target);
        this.axios.delete(`/api/intro/destroy/${id}`).then(response => {
          this.fetch();
          this.$notify({ type: "success", text: "Eintrag gelöscht" });
          this.progress(el);
        });
      }
    },

    toggle(id, event) {
      let el = this.progress(event.target);
      this.axios.get(`/api/intro/status/${id}`).then(response => {
        const index = this.intro.findIndex(x => x.id === id);
        this.intro[index].publish = response.data;
        this.$notify({ type: "success", text: "Status geändert" });
        this.progress(el);
      });
    }
  },
};
</script>