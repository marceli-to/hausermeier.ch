<template>
  <div>
    <page-header />
    <discourse-topic-form type="create"></discourse-topic-form>
  </div>
</template>
<script>
import PageHeader from '@/layout/PageHeader.vue';
import DiscourseTopicForm from '@/components/discourses/topic/form.vue';
  export default {
    components: {
      PageHeader,
      DiscourseTopicForm
    }
  }
</script>