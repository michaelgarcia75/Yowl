<template>
  <div class="postManager">
    <EachPost v-for="post in postsFiltered" :key="post.id" :post="post" :user="user" :comments="comments" :communities="communities" :users="users" />
  </div>
</template>

<script>
import EachPost from '@/components/SharedComponents/EachPost.vue'
export default {
  props: ['user', 'postsFiltered', 'comments', 'users', 'communities'],
  name: 'IndexView',
  components: {
    EachPost
  },
  data () {
    return {
    }
  },
  computed: {
  },
  methods: {
    deBug () {
      // console.log('this user in post manager is ', this.user)
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
