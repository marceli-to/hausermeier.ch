<template>
  <div class="box-wrapper">
    <article>
        <a
          href="javascript:;"
          class="btn-trash is-mini"
          @click.prevent="deleteText(element.id,$event)"
        >Löschen</a>
      <div>
        <div v-if="element.text">{{ element.text | truncate(200, '...') }}</div>
      </div>
    </article>
  </div>
</template>
<script>
import Grid from "@/components/home/grid/mixins/grid";
import Progress from "@/mixins/progress";

export default {
  props: {
    element: Object
  },

  mixins: [Grid, Progress],

  methods: {
    deleteText(id,event) {
      this.$parent.deleteText(id,event);
    },
  }
};
</script>