<template>
  <div>
    <page-header />
    <interaction-form type="edit"></interaction-form>
  </div>
</template>
<script>
import PageHeader from '@/layout/PageHeader.vue';
import InteractionForm from '@/components/interactions/projects/form.vue';
  export default {
    components: {
      PageHeader,
      InteractionForm
    }
  }
</script>