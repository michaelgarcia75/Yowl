<template>
    I'm add comment component
    <CommentsManager/>
</template>

<script>
// @ is an alias to /src
import CommentsManager from '@/components/SharedComponents/CommentsManager.vue'

export default {
  name: 'IndexView',
  components: {
    CommentsManager
  }
}
</script>
