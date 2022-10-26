<template>
  <div>
    <page-header/>
    <notifications classes="notification"/>
    <div class="container">
      <main class="content" role="main">
        <div>
          <h1>Kontakt</h1>
          <router-link :to="{ name: 'contact-create' }" class="btn-add">
            <span>Hinzufügen</span>
          </router-link>
          <div class="list-items" v-if="contact.length">
            <draggable 
              :disabled="false"
              v-model="contact" 
              @end="order()"
              ghost-class="draggable-ghost"
              draggable=".list-item">
              <div
                :class="[c.publish == 0 ? 'is-disabled' : '', 'list-item is-draggable']"
                v-for="c in contact"
                :key="c.id"
                data-icons="2"
              >
                <div class="list-item-body">
                  <div v-html="c.address.de">{{ c.address.de }}</div>
                </div>
                <div class="list-item-action" data-icons="2">
                  <a
                    href="javascript:;"
                    :class="[c.publish == 1 ? 'icon-eye' : 'icon-eye-off', 'icon-mini']"
                    @click.prevent="toggle(c.id,$event)"
                  ></a>
                  <router-link
                    :to="{name: 'contact-edit', params: { id: c.id }}"
                    class="icon-edit icon-mini"
                  ></router-link>
                </div>
              </div>
            </draggable>
          </div>
          <div v-else>
            <p>Es sind noch keine Daten vorhanden...</p>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>
<script>
import PageHeader from "@/layout/PageHeader.vue";
import Progress from "@/mixins/progress";
import draggable from 'vuedraggable';

export default {
  components: {
    PageHeader: PageHeader,
    draggable,
  },

  mixins: [Progress],

  data() {
    return {
      contact: []
    };
  },

  created() {
    this.fetch();
  },

  methods: {
    fetch() {
      this.axios.get(`/api/contact/get`).then(response => {
        this.contact = response.data.data;
      });
    },

    destroy(id, event) {
      if (confirm("Bitte löschen bestätigen!")) {
        let uri = `/api/contact/destroy/${id}`;
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
      this.axios.get(`/api/contact/status/${id}`).then(response => {
        const index = this.contact.findIndex(x => x.id === id);
        this.contact[index].publish = response.data;
        this.$notify({ type: "success", text: "Status geändert" });
        this.progress(el);
      });
    },
  }
};
</script>