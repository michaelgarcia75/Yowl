<template>
  <tr>
        <td>{{postId}}</td>
        <td>{{postTitle}}</td>
        <td>{{postUserId}}</td>
        <td>{{postCommunity}} </td>
        <td>{{commentsOfOnePost.length}}</td>
        <td>
            <button class='buttonDelete' @click="$emit('deletePost', postId)">Delete</button>
            <button class='buttonEdit' @click="$emit('passPost', postId)">Pass</button>
        </td>
    </tr>
    <!-- <AdminPostModal
    v-if="popupTrigger.buttonTrigger"
    :TogglePopUp="() => TogglePopUp('buttonTrigger')"
    :post="post">
    <h1 class="box" v-html="postTitle"></h1>
    </AdminPostModal> -->
</template>

<script>
import axios from 'axios'
// import { ref } from 'vue'
// import AdminPostModal from './AdminPostModal.vue'
export default {
  props: ['post'],
  // components: {
  //   AdminPostModal
  // },
  // setup () {
  //   const popupTrigger = ref({
  //     buttonTrigger: false
  //   })
  //   const TogglePopUp = (trigger) => {
  //     popupTrigger.value[trigger] = !popupTrigger.value[trigger]
  //   }
  //   return {
  //     popupTrigger,
  //     TogglePopUp
  //   }
  // },
  data () {
    return {
      commentsOfOnePost: [],
      users: [],
      communities: [],
      postId: this.post.id,
      postTitle: this.post.title,
      postUserId: this.post.user_id,
      postCommunity: this.post.community_id
    }
  },
  methods: {
    getCommentsByPost (postId) {
      axios.get('https://yowlteam.herokuapp.com/api/comments/post/' + postId)
        .then((response) => {
          this.commentsOfOnePost = response.data
        })
        .catch(error => console.log(error))
    },
    getUserName (userId) {
      // console.log('this user id is ', userId)
      axios.get('https://yowlteam.herokuapp.com/api/users')
        .then((response) => {
          this.users = response.data
          const user = this.users.filter((user) => user.id === userId)
          const userName = user[0].pseudo
          this.postUserId = userName
        })
        .catch(error => console.log(error))
    },
    getCommunityName (communityId) {
      axios.get('https://yowlteam.herokuapp.com/api/communities')
        .then((response) => {
          this.communities = response.data
          const community = this.communities.filter((community) => community.id === communityId)
          const communityName = community[0].name
          this.postCommunity = communityName
        })
        .catch(error => console.log(error))
    }
  },
  created () {
    this.getCommentsByPost(this.postId)
    this.getUserName(this.postUserId)
    this.getCommunityName(this.postCommunity)
  }
}
</script>

<style>
#firstTable{
  margin-left: auto;
  margin-right: auto;
}
.buttonEdit{
  background-color: white;
  border-radius: 3px;
  border-color: blue;
  margin-left: 3px;
}
.buttonDelete{
  background-color: white;
  border-radius: 3px;
  border-color: red;
}
</style>
