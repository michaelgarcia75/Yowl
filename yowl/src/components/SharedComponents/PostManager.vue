<template>
  <div class="postManager">
    <EachPost v-for="post in postsFiltered" :key="post.id" :post="post" :user="user" :comments="comments"/>
  </div>
</template>

<script>
import EachPost from '@/components/SharedComponents/EachPost.vue'
export default {
  props: ['postsFiltered', 'comments', 'user'],
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
      console.log('this user in post manager is ', this.user)
    }
  },
  created () {
    this.deBug()
  }
}
</script>

<style>
.postManager {
  background-color: aquamarine;
  width: 80%;
}
</style>
