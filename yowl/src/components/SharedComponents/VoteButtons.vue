<template>
  <img class="image" width="12" min-width="10" @click="changeUpvote(userId, post.id)" src="../../assets/up-arrow.png" />
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
      userId: 1
    }
  },
  methods: {
    changeUpvote (userId, postId) {
      console.log('user ', userId)
      console.log('nb of votes for ', postId, ' : ', this.postUpvotes)
      axios.get('https://yowlteam.herokuapp.com/api/upvotes')
        .then((response) => {
          this.upvoteJoint = response.data
          // console.log('upvote is ', this.upvoteJoint)
          if (this.upvoteJoint.some(el => el.user_id === userId && el.post_id === postId)) {
            console.log('YESYES')
            axios.delete('https://yowlteam.herokuapp.com/api/upvotes',
              {
                user_id: userId,
                post_id: postId
              })
            axios.put('https://yowlteam.herokuapp.com/api/posts/' + postId,
              {
                upvotes: this.postUpvotes - 1
              })
            this.postUpvotes = this.postUpvotes - 1
          } else {
            console.log('NONONO')
            axios.post('https://yowlteam.herokuapp.com/api/upvotes',
              {
                user_id: userId,
                post_id: postId
              }).then((response) => {
              console.log('response is', response)
              this.upvoteJoint.push(response)
            })
            axios.put('https://yowlteam.herokuapp.com/api/posts/' + postId,
              {
                upvotes: 1 + this.postUpvotes
              })
            this.postUpvotes = this.postUpvotes + 1
            // console.log('new upvotes is ', this.postUpvotes)
          }
        }
        )
    }
  }
}
</script>
