<template>
  <div class="postManager">
    <EachPost v-for="post in postsFiltered" :key="post.id" :post="post" :userId="user.id" :userName="user.pseudo"/>
  </div>
</template>

<script>
// import axios from 'axios'
import EachPost from '@/components/SharedComponents/EachPost.vue'
import { mapGetters } from 'vuex'
export default {
  props: ['postsFiltered'],
  name: 'IndexView',
  components: {
    EachPost
  },
  data () {
    return {
      user: {}
    }
  },
  computed: {
    ...mapGetters(['isLoggedIn', 'getUser'])
  },
  methods: {
  },
  created () {
    this.user = this.getUser
  }
}
</script>

<style>
.postManager {
  background-color: aquamarine;
  width: 80%;
}
</style>
