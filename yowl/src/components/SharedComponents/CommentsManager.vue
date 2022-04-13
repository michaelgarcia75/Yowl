<template>
COMMENT MANAGER
  <div class="commentManager">
    <EachComment  v-for="comment in commentsFiltered" :key="comment.id" :comment="comment" />
  </div>
</template>

<script>
import EachComment from '@/components/SharedComponents/EachComment.vue'

export default {
  props: ['commentsFiltered'],
  name: 'IndexView',
  components: {
    EachComment
  },
  methods: {
  }
}
</script>

<style>
.commentManager {
  background-color: aquamarine;
  width: 80%;
}
</style>
