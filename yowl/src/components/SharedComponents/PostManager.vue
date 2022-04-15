<template>
  <div class="postManager">
    <EachPost v-for="post in NewPostFiltered" :key="post.id"
    :post="post" :user="user" :comments="comments" :communities="communities" :users="users"
    @deletePost="deletePost"
    @ReportPost="ReportPost"
    />
  </div>
</template>

<script>
import axios from 'axios'
import EachPost from '@/components/SharedComponents/EachPost.vue'
export default {
  props: ['user', 'postsFiltered', 'comments', 'users', 'communities'],
  name: 'IndexView',
  components: {
    EachPost
  },
  data () {
    return {
      NewPostFiltered: this.postsFiltered
    }
  },
  computed: {
  },
  methods: {
    deBug () {
      // console.log('this user in post manager is ', this.user)
    },
    deletePost (postId) {
      axios.delete('https://yowlteam.herokuapp.com/api/posts/' + postId)
        .then((response) => {
          this.NewPostFiltered = [...this.NewPostFiltered.filter((element) => element.id !== postId)]
        })
      // .then((response) => {
      //   axios.get('https://yowlteam.herokuapp.com/api/posts/user/' + this.userID)
      //     .then((response) => {
      //     // console.log('posts is', response.data)
      //       this.NewPostFiltered = response.data
      //     // console.log('post filtered is', this.postsFiltered)
      //     })
      //     .catch(error => console.log(error))
      // })
    },
    ReportPost (postId) {
      console.log('in report post post id is ', postId)
      axios.put('https://yowlteam.herokuapp.com/api/posts/' + postId,
        {
          is_reported: 1
        })
    }
  },
  created () {
    this.deBug()
    // console.log('B: ', this.communities)
  }
}
</script>

<style>
.postManager {
  background-color: antiquewhite;
  width: 80%;
  margin-left:25%;
}
</style>
