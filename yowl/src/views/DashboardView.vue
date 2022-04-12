<template>
    <div class="dashboard">
        <UserSettings/>
        <div class="postLinks">
          <p>POSTS</p>
          <p>COMMENTS</p>
          <p>UPVOTES</p>
        </div>
        <!--<PostManager />
        <CommentsManager/>
        <UpVotedPostsManager/> -->

    </div>
</template>

<script>
// @ is an alias to /src
import UserSettings from '@/components/SpecialComponents/UserSettings.vue'
// import PostManager from '@/components/SharedComponents/PostManager.vue'
// import CommentsManager from '@/components/SharedComponents/CommentsManager.vue'
// import UpVotedPostsManager from '@/components/SharedComponents/UpVotedPostsManager.vue'

export default {
  name: 'AdminView',
  components: {
    UserSettings
    // PostManager,
    // CommentsManager,
    // UpVotedPostsManager
  }
}
</script>

<style scoped>
.postLinks{
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;

}
.postLinks p{
  margin-right: 13px;
  font-size: 25px;
  cursor: pointer;
}
.postLinks p:hover{
  text-decoration: underline;
  color: rgb(14, 164, 233);

}
.dashboard{
  margin-left: 25%;
}

</style>
