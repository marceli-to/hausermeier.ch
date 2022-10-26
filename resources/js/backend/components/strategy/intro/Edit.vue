<template>
  <div>
    <page-header />
    <intro-form type="edit"></intro-form>
  </div>
</template>
<script>
import PageHeader from '@/layout/PageHeader.vue';
import IntroForm from '@/components/strategy/intro/form.vue';
  export default {
    components: {
      PageHeader,
      IntroForm
    }
  }
</script>