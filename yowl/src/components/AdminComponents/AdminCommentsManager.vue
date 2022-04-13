<template>
    <AdminNavButtons></AdminNavButtons>
    <table id="firstTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>User Name</th>
        <th>Comment</th>
        <th>in response to</th>
        <th>actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- <div
        v-for='user in users'
        :key='user.id'
      > -->
        <AdminEachComment v-for='comment in comments' :key='comment.id' :comment="comment"
        ></AdminEachComment>
      <!-- </div> -->
    </tbody>
  </table>
</template>

<script>
import axios from 'axios'
import AdminEachComment from './AdminEachComment.vue'
import AdminNavButtons from '@/components/AdminComponents/AdminNavButtons.vue'
export default {
  data () {
    return {
      comments: []
    }
  },
  components: {
    AdminEachComment,
    AdminNavButtons
  },
  methods: {
  },
  created () {
    axios.get('https://yowlteam.herokuapp.com/api/comments')
      .then((response) => {
        // console.log('posts is', response.data)
        this.comments = response.data
        this.comments = [...this.comments.filter((element) => element.is_reported !== 0)]
        // console.log('AFTERRRRRR posts is', this.posts)
      })
      .catch(error => console.log(error))
  }
}
</script>
