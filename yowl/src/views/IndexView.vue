<template>
  <div class="index">
    <p v-if="searchContent"> Research : {{searchContent}}</p>
    <CreatePostButton @save="save" @filesChange="filesChange"/>
    <PostManager :user="user" :postsFiltered="postsFiltered"/>
    <TopCommunities/>
        <router-link to="/communities">Communities</router-link>
  </div>
</template>

<script>
import axios from 'axios'
import CreatePostButton from '@/components/SharedComponents/CreatePostButton.vue'
import PostManager from '@/components/SharedComponents/PostManager.vue'
import TopCommunities from '@/components/SharedComponents/TopCommunities.vue'
import { mapGetters } from 'vuex'

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
      user: []
    }
  },
  methods: {
  },
  computed: {
    ...mapGetters(['isLoggedIn', 'getToken', 'getUser'])
  },
  created () {
    this.user = this.getUser
    console.log(this.user)
    axios
      .get('https://yowlteam.herokuapp.com/api/posts')
      .then((response) => {
        this.posts = response.data
      })
      .catch((error) => console.log(error))
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
  }
}
</script>
