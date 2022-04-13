<template>
  <tr>
    <td>{{commentId}}</td>
    <td>{{commentUserId}}</td>
    <td>{{commentContent}}</td>
    <td>{{commentPostId}} </td>
    <td>
        <button class='button' @click="$emit('deleteComment', commentId)">Delete</button>
        <button class='button' @click="$emit('passComment', commentId)">Pass</button>
    </td>
  </tr>
    <!-- <AdminPostModal></AdminPostModal> -->
</template>

<script>
import axios from 'axios'
// import AdminPostModal from './AdminPostModal.vue'
export default {
  props: ['comment'],
  data () {
    return {
      commentId: this.comment.id,
      commentContent: this.comment.content,
      commentUserId: this.comment.user_id,
      commentPostId: this.comment.post_id,
      users: [],
      posts: []
    }
  },
  // components: {
  //   AdminPostModal
  // }
  methods: {
    getUserName (userId) {
      // console.log('this user id is ', userId)
      axios.get('https://yowlteam.herokuapp.com/api/users')
        .then((response) => {
          this.users = response.data
          const user = this.users.filter((user) => user.id === userId)
          const userName = user[0].pseudo
          this.commentUserId = userName
        })
        .catch(error => console.log(error))
    },
    getPostTitle (postId) {
      // console.log('this user id is ', userId)
      axios.get('https://yowlteam.herokuapp.com/api/posts')
        .then((response) => {
          this.posts = response.data
          const post = this.posts.filter((post) => post.id === postId)
          const postTitle = post[0].title
          this.commentPostId = postTitle
        })
        .catch(error => console.log(error))
    }
  },
  created () {
    this.getUserName(this.commentUserId)
    this.getPostTitle(this.commentPostId)
  }
}
</script>
