<template>
  <div>
    <page-header />
    <project-program-form type="create"></project-program-form>
  </div>
</template>
<script>
import PageHeader from '@/layout/PageHeader.vue';
import ProjectProgramForm from '@/components/projects/program/form.vue';
  export default {
    components: {
      PageHeader,
      ProjectProgramForm
    }
  }
</script>