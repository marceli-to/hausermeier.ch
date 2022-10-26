<template>
  <div>
    <page-header />
    <strategy-form type="create"></strategy-form>
  </div>
</template>
<script>
import PageHeader from '@/layout/PageHeader.vue';
import StrategyForm from '@/components/strategy/projects/form.vue';
  export default {
    components: {
      PageHeader,
      StrategyForm
    }
  }
</script>