<template>
    <div class="dashboard">
        <UserSettings/>
        <PostManager/>
        <CommentsManager/>
        <UpVotedPostsManager/>
    </div>
</template>

<script>
// @ is an alias to /src
import UserSettings from '@/components/SpecialComponents/UserSettings.vue'
import PostManager from '@/components/SharedComponents/PostManager.vue'
import CommentsManager from '@/components/SharedComponents/CommentsManager.vue'
import UpVotedPostsManager from '@/components/SharedComponents/UpVotedPostsManager.vue'

export default {
  name: 'AdminView',
  components: {
    UserSettings,
    PostManager,
    CommentsManager,
    UpVotedPostsManager
  }
}
</script>
