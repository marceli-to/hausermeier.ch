<template>
  <div>
    <a
      href="javascript:;"
      class="btn-add-article"
      @click.prevent="createArticle(gridId,gridPosition);"
    >News auswählen</a>
  </div>
</template>
<script>
export default {
  props: {
    gridId: Number,
    gridPosition: Number,
  },
  methods: {
    createArticle(gridId,position) {
      this.$parent.createArticle(gridId, position);
    },
  }
};
</script>