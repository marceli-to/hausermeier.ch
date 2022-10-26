<template>
  <div>
    <page-header/>
    <notifications classes="notification"/>
    <div class="container">
      <main class="content" role="main">
        <div>
          <h1>Interaktion – Projekte</h1>
          <router-link :to="{ name: 'interaction-project-create' }" class="btn-add">
            <span>Hinzufügen</span>
          </router-link>
          <div class="list-items" v-if="interactions.length">
            <draggable 
              :disabled="false"
              v-model="interactions" 
              @end="order()"
              ghost-class="draggable-ghost"
              draggable=".list-item">
              <div
                :class="[i.publish == 0 ? 'is-disabled' : '', 'list-item is-draggable']"
                v-for="i in interactions"
                :key="i.id"
                data-icons="3"
              >
                <div class="list-item-body">{{ i.title.de }}</div>
                <div class="list-item-action" data-icons="3">
                  <a
                    href="javascript:;"
                    :class="[i.publish == 1 ? 'icon-eye' : 'icon-eye-off', 'icon-mini']"
                    @click.prevent="toggle(i.id,$event)"
                  ></a>
                  <router-link
                    :to="{name: 'interaction-project-edit', params: { id: i.id }}"
                    class="icon-edit icon-mini"
                  ></router-link>
                  <a
                    href="javascript:;"
                    class="icon-trash icon-mini"
                    @click.prevent="destroy(i.id,$event)"
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
      interactions: [],
    };
  },

  created() {
    this.fetch();
  },

  methods: {
    fetch() {
      this.axios.get(`/api/interaction/projects/get`).then(response => {
        this.interactions = response.data;
      });
    },

    destroy(id, event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/interaction/project/destroy/${id}`;
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
      this.axios.get(`/api/interaction/project/status/${id}`).then(response => {
        const index = this.interactions.findIndex(x => x.id === id);
        this.interactions[index].publish = response.data;
        this.$notify({ type: "success", text: "Status geändert" });
        this.progress(el);
      });
    },

    order() {
      let interactions = this.interactions.map(function(interaction, index) {
          interaction.order = index;
          return interaction;
      });

      if (this.debounce) return;
      this.debounce = setTimeout(function() {
        this.debounce = false 
        this.axios.post(`/api/interaction/project/order`, {interactions: interactions}).then((response) => {
          this.$notify({type: 'success', text: 'Reihenfolge angepasst'});
        });
      }.bind(this, interactions), 500);
    },

  },

};
</script>