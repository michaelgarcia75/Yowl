<template>
I'm post Modal !
  <EachPost/>
  <AddComment/>
</template>

<script>
// @ is an alias to /src
import EachPost from '@/components/SharedComponents/EachPost.vue'
import AddComment from '@/components/SharedComponents/AddComment.vue'

export default {
  name: 'IndexView',
  components: {
    EachPost,
    AddComment
  }
}
</script>
