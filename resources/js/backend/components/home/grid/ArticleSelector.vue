<template>
  <div>
    <h1>News auswählen</h1>
    <div class="grid-article-selector">
      <div v-for="n in news" :key="n.id" @click.prevent="storeArticle(n.id)">
        <div class="grid-article-selector__item">
          <div v-if="n.date.de">{{n.date.de}}</div>
          <h2 v-if="n.title.de">{{ n.title.de }}</h2>
          <div class="item-text" v-if="n.description.de">{{ n.description.de | truncate(25, '...') }}</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  
  data() {
    return {
    }
  },

  props: {
    news: Array
  },

  methods: {
    storeArticle(newsId) {
      this.$parent.storeArticle(newsId);
    },
  },
  
  computed: {
    filtered() {
      return this.$props.news.filter(n => {
        return n;
      })
    }
  }
};
</script>