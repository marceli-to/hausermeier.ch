<template>
  <div>
    <page-header />
    <home-news-form type="edit"></home-news-form>
  </div>
</template>
<script>
import PageHeader from '@/layout/PageHeader.vue';
import HomeNewsForm from '@/components/home/news/form.vue';
  export default {
    components: {
      PageHeader,
      HomeNewsForm
    }
  }
</script>