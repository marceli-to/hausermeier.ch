<template>
  <div class="box-wrapper">
    <article :class="element.layout == 1 ? 'is-colored' : ''">
        <a
          href="javascript:;"
          class="btn-trash is-mini"
          @click.prevent="deleteArticle(element.id,$event)"
        >Löschen</a>
      <div>
        <div>{{element.date}}</div>
        <h2 v-if="element.title">{{ element.title }}</h2>
        <div v-if="element.description">{{ element.description | truncate(200, '...') }}</div>
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
    deleteArticle(id,event) {
      this.$parent.deleteArticle(id,event);
    },
  }
};
</script>