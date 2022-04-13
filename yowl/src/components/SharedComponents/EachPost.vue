<template>
  <div class="eachPost">
    <h1>{{ post.title }}</h1>
    <br />
    {{ post.content }}
    <br />
    <br />
    <VoteButtons :post="post" />
    <CommentsManager :commentsFiltered="commentsFiltered"/>
  </div>
</template>

<script>
// @ is an alias to /src
import VoteButtons from '@/components/SharedComponents/VoteButtons.vue'
import axios from 'axios'
import CommentsManager from '@/components/SharedComponents/CommentsManager.vue'

export default {
  props: ['post'],
  name: 'IndexView',
  components: {
    VoteButtons,
    CommentsManager
  },
  data () {
    return {
      commentsFiltered: []
    }
  },
  created () {
    axios.get('https://yowlteam.herokuapp.com/api/comments/post/' + this.post.id)
      .then((response) => {
        // console.log('comments is', response.data)
        this.commentsFiltered = response.data
        // console.log('comments filtered is', this.commentsFiltered)
      })
      .catch(error => console.log(error))
  }
}
</script>

<style scoped>
.eachPost {
  background-color: antiquewhite;
  padding: 10px;
  margin: 20px;
}
</style>
