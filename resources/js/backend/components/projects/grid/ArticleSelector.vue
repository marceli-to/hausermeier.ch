<template>
  <div>
    <h1>Text auswählen</h1>
    <div class="grid-article-selector">
      <div v-for="t in text" :key="t.id" @click.prevent="storeText(t.id)">
        <div class="grid-article-selector__item">
          <div class="item-text" v-if="t.text.de">{{ t.text.de | truncate(25, '...') }}</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {

  props: {
    text: Array
  },

  methods: {
    storeText(newsId) {
      this.$parent.storeText(newsId);
    },
  },
};
</script>