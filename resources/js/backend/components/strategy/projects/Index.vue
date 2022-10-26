<template>
  <div>
    <page-header/>
    <notifications classes="notification"/>
    <div class="container">
      <main class="content" role="main">
        <div>
          <h1>Strategie &amp; Entwicklung – Projekte</h1>
          <router-link :to="{ name: 'strategy-project-create' }" class="btn-add">
            <span>Hinzufügen</span>
          </router-link>
          <div class="list-items" v-if="strategies.length">
            <draggable 
              :disabled="false"
              v-model="strategies" 
              @end="order()"
              ghost-class="draggable-ghost"
              draggable=".list-item">
              <div
                :class="[s.publish == 0 ? 'is-disabled' : '', 'list-item is-draggable']"
                v-for="s in strategies"
                :key="s.id"
                data-icons="3"
              >
                <div class="list-item-body">{{ s.title.de }}</div>
                <div class="list-item-action" data-icons="3">
                  <a
                    href="javascript:;"
                    :class="[s.publish == 1 ? 'icon-eye' : 'icon-eye-off', 'icon-mini']"
                    @click.prevent="toggle(s.id,$event)"
                  ></a>
                  <router-link
                    :to="{name: 'strategy-project-edit', params: { id: s.id }}"
                    class="icon-edit icon-mini"
                  ></router-link>
                  <a
                    href="javascript:;"
                    class="icon-trash icon-mini"
                    @click.prevent="destroy(s.id,$event)"
                  ></a>
                </div>
              </div>
            </draggable>
          </div>
          <div v-else>
            <p>Es sind noch keine Einträge vorhanden...</p>
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
      strategies: [],
    };
  },

  created() {
    this.fetch();
  },

  methods: {
    fetch() {
      this.axios.get(`/api/strategy/projects/get`).then(response => {
        this.strategies = response.data;
      });
    },

    destroy(id, event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/strategy/project/destroy/${id}`;
        let el = this.progress(event.target);
        this.axios.delete(uri).then(response => {
          this.fetch();
          this.$notify({ type: "success", text: "Eintrag gelöscht" });
          this.progress(el);
        });
      }
    },

    toggle(id, event) {
      let el = this.progress(event.target);
      this.axios.get(`/api/strategy/project/status/${id}`).then(response => {
        const index = this.strategies.findIndex(x => x.id === id);
        this.strategies[index].publish = response.data;
        this.$notify({ type: "success", text: "Status geändert" });
        this.progress(el);
      });
    },

    order() {
      let strategies = this.strategies.map(function(strategy, index) {
          strategy.order = index;
          return strategy;
      });

      if (this.debounce) return;
      this.debounce = setTimeout(function() {
        this.debounce = false 
        this.axios.post(`/api/strategy/project/order`, {strategies: strategies}).then((response) => {
          this.$notify({type: 'success', text: 'Reihenfolge angepasst'});
        });
      }.bind(this, strategies), 500);
    },
  },

};
</script>