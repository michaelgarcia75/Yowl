<template>
  <div class="postManager">
    <EachPost v-for="post in postsFiltered" :key="post.id" :post="post" :user="user"/>
  </div>
</template>

<script>
import EachPost from '@/components/SharedComponents/EachPost.vue'
export default {
  props: ['postsFiltered', 'user'],
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
  },
  created () {
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
