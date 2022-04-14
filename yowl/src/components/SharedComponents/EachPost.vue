<template>
  <div class="eachPost">
    <p>{{community.name}} Posted by {{postUser.pseudo}} {{moment(date).fromNow()}}</p>
    <h1>{{ post.title }}</h1>
    <br />
    {{ post.content }}
    <br />
    <br />
    <VoteButtons :post="post" />
    <CommentsManager :user="user" :commentsFiltered="commentsFiltered" :postId="postId"/>
  </div>
</template>

<script>
import moment from 'moment'
import axios from 'axios'
import VoteButtons from '@/components/SharedComponents/VoteButtons.vue'
import CommentsManager from '@/components/SharedComponents/CommentsManager.vue'

export default {
  props: ['post', 'user'],
  name: 'IndexView',
  components: {
    VoteButtons,
    CommentsManager
  },
  data () {
    return {
      commentsFiltered: [],
      community: [],
      date: this.post.created_at,
      postId: this.post.id,
      postUser: []
    }
  },
  created () {
    this.moment = moment
    axios.get('https://yowlteam.herokuapp.com/api/users/' + this.post.user_id)
      .then((response) => {
        this.postUser = response.data
      })
      .catch(error => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/comments/post/' + this.post.id)
      .then((response) => {
        // console.log('comments is', response.data)
        this.commentsFiltered = response.data
        // console.log('comments filtered is', this.commentsFiltered)
      })
      .catch(error => console.log(error))

    axios.get('https://yowlteam.herokuapp.com/api/communities/' + this.post.community_id)
      .then((response) => {
        this.community = response.data
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
