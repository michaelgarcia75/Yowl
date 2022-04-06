<template>
  <div class="community">
    <CreatePostButton/>
    <PostManager/>
  </div>
  <router-view/>
</template>

<script>
// @ is an alias to /src
import CreatePostButton from '@/components/SharedComponents/CreatePostButton.vue'
import PostManager from '@/components/SharedComponents/PostManager.vue'

export default {
  name: 'AdminView',
  components: {
    CreatePostButton,
    PostManager
}
</script>
