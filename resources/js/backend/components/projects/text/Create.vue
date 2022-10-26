<template>
  <div>
    <page-header />
    <project-text-form type="create"></project-text-form>
  </div>
</template>
<script>
import PageHeader from '@/layout/PageHeader.vue';
import ProjectTextForm from '@/components/projects/text/form.vue';
  export default {
    components: {
      PageHeader,
      ProjectTextForm
    }
  }
</script>