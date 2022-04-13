<template>
    <AdminNavButtons></AdminNavButtons>
    <table id="firstTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>User Name</th>
        <th>Community</th>
        <th>Comments</th>
        <th>actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- <div
        v-for='user in users'
        :key='user.id'
      > -->
        <AdminEachPost v-for='post in posts' :key='post.id' :post="post"
        @deletePost='deletePost'
        @passPost='passPost'
        ></AdminEachPost>
      <!-- </div> -->
    </tbody>
  </table>
</template>

<script>
import axios from 'axios'
import AdminEachPost from './AdminEachPost.vue'
import AdminNavButtons from '@/components/AdminComponents/AdminNavButtons.vue'
export default {
  data () {
    return {
      posts: []
    }
  },
  components: {
    AdminEachPost,
    AdminNavButtons
  },
  methods: {
    deletePost (postId) {
      console.log('in delete post function ', postId)
      axios.delete('https://yowlteam.herokuapp.com/api/posts/' + postId)
        .then((response) => {
          console.log('in side response')
          console.log('response is ', response)
          this.posts = [...this.posts.filter((element) => element.id !== postId)]
        })
    },
    passPost (postId) {
      // console.log('in delete post function ', postId)
      axios.put('https://yowlteam.herokuapp.com/api/posts/' + postId,
        {
          is_reported: 0
        })
        .then((response) => {
          this.posts = [...this.posts.filter((element) => element.id !== postId)]
          // console.log('AFTERRRRRR posts is', this.posts)
        })
        .catch(error => console.log(error))
    }
  },
  created () {
    axios.get('https://yowlteam.herokuapp.com/api/posts')
      .then((response) => {
        // console.log('posts is', response.data)
        this.posts = response.data
        this.posts = [...this.posts.filter((element) => element.is_reported !== 0)]
        // console.log('AFTERRRRRR posts is', this.posts)
      })
      .catch(error => console.log(error))
  }
}
</script>
