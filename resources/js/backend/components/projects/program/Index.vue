<template>
  <div>
    <page-header/>
    <notifications classes="notification"/>
    <div class="container">
      <main class="content" role="main">
        <div>
          <h1>Thema - Werkliste</h1>
          <router-link :to="{ name: 'project-program-create' }" class="btn-add">
            <span>Hinzufügen</span>
          </router-link>
          <div class="list-items" v-if="programs">
            <draggable 
              :disabled="false"
              v-model="programs" 
              @end="order()"
              ghost-class="draggable-ghost"
              draggable=".list-item">
              <div
                :class="[p.publish == 0 ? 'is-disabled' : '', 'list-item is-draggable']"
                v-for="p in programs"
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
                    :to="{name: 'project-program-edit', params: { id: p.id }}"
                    class="icon-edit icon-mini"
                  ></router-link>
                  <a
                    href="javascript:;"
                    class="icon-trash icon-mini"
                    @click.prevent="destroy(p.id,$event)"
                  ></a>
                </div>
              </div>
            </draggable>
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
import draggable from "vuedraggable";
import Progress from "@/mixins/progress";

export default {
  components: {
    draggable,
    PageHeader,
  },

  mixins: [Progress],

  data() {
    return {
      programs: [],
    };
  },

  created() {
    this.fetch();
  },

  methods: {

    fetch() {
      this.axios.get(`/api/project/program/get`).then(response => {
        this.programs = response.data;
      });
    },

    destroy(id,event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let el = this.progress(event.target);
        this.axios.delete(`/api/project/program/destroy/${id}`).then(response => {
          this.fetch();
          this.$notify({ type: "success", text: "Eintrag gelöscht" });
          this.progress(el);
        });
      }
    },

    toggle(id, event) {
      let el = this.progress(event.target);
      this.axios.get(`/api/project/program/status/${id}`).then(response => {
        const index = this.programs.findIndex(x => x.id === id);
        this.programs[index].publish = response.data;
        this.$notify({ type: "success", text: "Status geändert" });
        this.progress(el);
      });
    },

    order() {
      let programs = this.programs.map(function(program, index) {
          program.order = index;
          return program;
      });

      if (this.debounce) return;
      this.debounce = setTimeout(function() {
        this.debounce = false 
        this.axios.post(`/api/project/program/order`, {programs: programs}).then((response) => {
          this.$notify({type: 'success', text: 'Reihenfolge angepasst'});
        });
      }.bind(this, programs), 500);
    },

  },

};
</script>