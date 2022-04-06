<template>
I'm create post button
  <CreatePostModal/>
</template>

<script>
// @ is an alias to /src
import CreatePostModal from '@/components/SharedComponents/CreatePostModal.vue'

export default {
  name: 'IndexView',
  components: {
    CreatePostModal
  }
}
</script>
