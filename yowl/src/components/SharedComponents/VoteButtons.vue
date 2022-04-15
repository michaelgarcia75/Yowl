<template>
  <img class="image" v-if="arrowColor === false" width="12" min-width="10" @click="putUpvote(userId, post.id)" src="../../assets/up-arrow.png" />
  <img class="image" v-if="arrowColor === true" width="12" min-width="10" @click="removeUpvote(userId, post.id)" src="../../assets/up-arrow-black.png" />
  <p>{{ postUpvotes }}</p>
  <!-- <img class="image" width="12" min-width="10" @click="$emit('downvote', post.id)" src="../../assets/down-arrow.png" /> -->
</template>
<script>
import axios from 'axios'

export default {
  props: ['post'],
  data () {
    return {
      upvoteJoint: [],
      postUpvotes: this.post.upvotes,
      userId: 1,
      arrowColor: false,
      isInProgress: false
    }
  },
  methods: {
    async removeUpvote (userId, postId) {
      if (this.isInProgress === true) { return }
      this.isInProgress = true
      // if (this.upvoteJoint.some(el => el.user_id === userId && el.post_id === postId)) {
      await axios.delete('https://yowlteam.herokuapp.com/api/upvotes',
        {
          data: {
            user_id: userId,
            post_id: postId
          }
        })
      this.arrowColor = false
      await axios.put('https://yowlteam.herokuapp.com/api/posts/' + postId,
        {
          upvotes: this.postUpvotes - 1
        })
      this.postUpvotes = this.postUpvotes - 1
      this.isInProgress = false
    },
    async putUpvote (userId, postId) {
      if (this.isInProgress === true) { return }
      this.isInProgress = true
      await axios.post('https://yowlteam.herokuapp.com/api/upvotes',
        {
          user_id: userId,
          post_id: postId
        }).then((response) => {
        this.upvoteJoint.push(response)
        this.arrowColor = true
      })
      await axios.put('https://yowlteam.herokuapp.com/api/posts/' + postId,
        {
          upvotes: 1 + this.postUpvotes
        })
      this.postUpvotes = this.postUpvotes + 1
      this.isInProgress = false
    }
  },
  created () {
    axios.get('https://yowlteam.herokuapp.com/api/upvotes')
      .then((response) => {
        this.upvoteJoint = response.data
      })
  }
}
</script>

<style>
.image{
  cursor: pointer;
}
</style>
