<template>
  <div>
    <page-header />
    <intro-form type="create"></intro-form>
  </div>
</template>
<script>
import PageHeader from '@/layout/PageHeader.vue';
import IntroForm from '@/components/projects/intro/form.vue';
  export default {
    components: {
      PageHeader,
      IntroForm
    }
  }
</script>