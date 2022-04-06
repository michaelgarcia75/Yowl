<template>
    Comment manager
    <EachComment/>
</template>

<script>
// @ is an alias to /src
import EachComment from '@/components/SharedComponents/EachComment.vue'

export default {
  name: 'IndexView',
  components: {
    EachComment
  }
}
</script>
