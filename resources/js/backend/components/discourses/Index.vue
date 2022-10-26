<template>
  <div>
    <page-header/>
    <notifications classes="notification"/>
    <div class="container">
      <main class="content" role="main">
        <div>
          <h1>Aktuell</h1>
          <router-link :to="{ name: 'discourse-create' }" class="btn-add">
            <span>Hinzufügen</span>
          </router-link>
          <div class="list-items" v-if="discourses.length && isFetched">
            <div
              :class="[d.publish == 0 ? 'is-disabled' : '', 'list-item']"
              v-for="d in discourses"
              :key="d.id"
              data-icons="3"
            >
              <div class="list-item-body">
                {{ d.date }} – {{ d.title.de }} 
                <em class="bubble is-info" v-if="d.is_all == 1">Alle</em>
                <em class="bubble is-info" v-if="d.is_discourse == 1">Diskurs</em>
                <em class="bubble is-info" v-if="d.is_publication == 1">Publikation</em>
              </div>
              <div class="list-item-action" data-icons="3">
                <a
                  href="javascript:;"
                  :class="[d.publish == 1 ? 'icon-eye' : 'icon-eye-off', 'icon-mini']"
                  @click.prevent="toggle(d.id,$event)"
                ></a>
                <router-link
                  :to="{name: 'discourse-edit', params: { id: d.id }}"
                  class="icon-edit icon-mini"
                ></router-link>
                <a
                  href="javascript:;"
                  class="icon-trash icon-mini"
                  @click.prevent="destroy(d.id,$event)"
                ></a>
              </div>
            </div>
          </div>
          <div v-else>
            <p>Es sind noch keine Diskurs-Einträge vorhanden...</p>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>
<script>
import PageHeader from "@/layout/PageHeader.vue";
import draggable from "vuedraggable";
import Progress from "@/mixins/progress";

export default {
  components: {
    draggable,
    PageHeader: PageHeader
  },

  mixins: [Progress],

  data() {
    return {
      discourses: [],
      isFetched: false,
    };
  },

  created() {
    this.fetch();
  },

  methods: {
    fetch() {
      this.isFetched = false;
      this.axios.get(`/api/discourses/get`).then(response => {
        this.discourses = response.data;
        this.isFetched = true;
      });
    },

    destroy(id, event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/discourse/destroy/${id}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          this.fetch();
          this.$notify({ type: "success", text: "Eintrag gelöscht" });
          this.progress(el);
        });
      }
    },

    toggle(id, event) {
      let el = this.progress(event.target),
        discourses = this.discourses;
      this.axios.get(`/api/discourse/status/${id}`).then(response => {
        Object.keys(discourses).forEach(function(key) {
          const index = discourses[key].findIndex(x => x.id === id);
          if (index > -1) {
            discourses[key][index].publish = response.data;
          }
        });
        this.discourses = discourses;
        this.$notify({ type: "success", text: "Status geändert" });
        this.progress(el);
      });
    },

    order() {
      let discourses = this.discourses.map(function(discourse, index) {
        discourse.order = index;
        return discourse;
      });

      if (this.debounce) return;
      this.debounce = setTimeout(
        function() {
          this.debounce = false;
          this.axios
            .post(`/api/discourse/order`, { discourses: discourses })
            .then(response => {
              this.$notify({ type: "success", text: "Reihenfolge angepasst" });
            });
        }.bind(this, discourses),
        500
      );
    }
  }
};
</script>