<template>
  <div>
    <a
      href="javascript:;"
      class="btn-add-article"
      @click.prevent="createText(gridId,gridPosition);"
    >Text auswählen</a>
  </div>
</template>
<script>
export default {
  props: {
    gridId: Number,
    gridPosition: Number,
  },
  methods: {
    createText(gridId,position) {
      this.$parent.createText(gridId,position);
    },
  }
};
</script>