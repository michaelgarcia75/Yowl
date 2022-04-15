<template>
  <div class="postManager">
    <EachPost v-for="post in NewPostFiltered" :key="post.id"
    :post="post" :user="user" :comments="comments" :communities="communities" :users="users"
    @deletePost="deletePost"
    @ReportPost="ReportPost"
    :PostIsReported="PostIsReported"
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
    deletePost (postId) {
      axios.delete('https://yowlteam.herokuapp.com/api/posts/' + postId)
        .then((response) => {
          this.NewPostFiltered = [...this.NewPostFiltered.filter((element) => element.id !== postId)]
        })
    }
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
