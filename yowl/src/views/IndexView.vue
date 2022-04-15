<template>
  <div class="index">
    <p v-if="searchContent"> Research : {{searchContent}}</p>
    <CreatePostButton @save="save" @filesChange="filesChange" :user="user"/>
    <PostManager v-if="comments.length !== 0 && communities.length !== 0" :user="user" :postsFiltered="postsFiltered" :comments="comments" :communities="communities" @ReportPost="ReportPost" @deletePost="deletePost" :users="users"/>
    <TopCommunities/>
        <router-link to="/communities">Communities</router-link>
  </div>
</template>

<script>
import axios from 'axios'
import CreatePostButton from '@/components/SharedComponents/CreatePostButton.vue'
import PostManager from '@/components/SharedComponents/PostManager.vue'
import TopCommunities from '@/components/SharedComponents/TopCommunities.vue'
import { mapState, mapGetters } from 'vuex'

export default {
  name: 'IndexView',
  props: ['postsFiltered', 'searchContent'],
  components: {
    CreatePostButton,
    PostManager,
    TopCommunities
  },
  data () {
    return {
      posts: [],
      categories: [],
      communities: [],
      comments: [],
      users: []
    }
  },
  methods: {
    deletePost (postId) {
      axios.delete('https://yowlteam.herokuapp.com/api/posts/' + postId)
    },
    ReportPost (postId) {
      console.log('in report post post id is ', postId)
      axios.put('https://yowlteam.herokuapp.com/api/posts/' + postId,
        {
          is_reported: 1
        })
    }
  },
  computed: {
    ...mapState(['user']),
    ...mapGetters(['isLoggedIn', 'getToken', 'getUser'])
  },
  created () {
    this.user = this.getUser
    axios
      .get('https://yowlteam.herokuapp.com/api/categories')
      .then((response) => {
        this.categories = response.data
      })
      .catch((error) => console.log(error))
    axios
      .get('https://yowlteam.herokuapp.com/api/communities')
      .then((response) => {
        this.communities = response.data
      })
      .catch((error) => console.log(error))
    // console.log('A: ', this.communities)
    axios
      .get('https://yowlteam.herokuapp.com/api/comments')
      .then((response) => {
        this.comments = response.data
      })
      .catch((error) => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/users')
      .then((response) => {
        this.users = response.data
      })
      .catch(error => console.log(error))
  }
}
</script>

<style>
body{
  background-color: antiquewhite;
}
</style>
