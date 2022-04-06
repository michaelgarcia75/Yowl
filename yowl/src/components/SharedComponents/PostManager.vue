<template>
I'm the post manager
  <EachPost/>
</template>

<script>
// @ is an alias to /src
import EachPost from '@/components/SharedComponents/EachPost.vue'

export default {
  name: 'IndexView',
  components: {
    EachPost
  }
}
</script>
