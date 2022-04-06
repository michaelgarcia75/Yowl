<template>
  <div class="index">
    <img alt="Vue logo" src="../assets/logo.png">
    <CreatePostButton/>
    <PostManager/>
    <TopCommunities/>
  </div>
</template>

<script>
// @ is an alias to /src
import CreatePostButton from '@/components/SharedComponents/CreatePostButton.vue'
import PostManager from '@/components/SharedComponents/PostManager.vue'
import TopCommunities from '@/components/SharedComponents/TopCommunities.vue'

export default {
  name: 'IndexView',
  components: {
    CreatePostButton,
    PostManager,
    TopCommunities
  }
}
</script>
