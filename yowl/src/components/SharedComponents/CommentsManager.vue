<template>
<button v-if="isOpen" @click="isOpen=false">Show Comments</button>
<button v-if="!isOpen" @click="isOpen=true">Hide Comments</button>
<button v-if="isAdd" @click="isAdd=false">Add Comment</button>
<button v-if="!isAdd" @click="createComment(newComment), isAdd=true">Submit Comment</button>
<span id="returnButton" v-if="!isAdd" @click="isAdd=true">↩️</span>
<br>
<textarea v-if="!isAdd" v-model="newComment" class="addComment">
  </textarea>
  <div class="commentManager" v-if="!isOpen">
    <EachComment  v-for="comment in commentsFiltered" :key="comment.id" :user="user" :comment="comment" :users="users">HELLO</EachComment>
  </div>
</template>

<script>
import EachComment from '@/components/SharedComponents/EachComment.vue'
import axios from 'axios'
// import { mapGetters } from 'vuex'

export default {
  props: ['commentsFiltered', 'postId', 'users', 'user'],
  name: 'IndexView',
  components: {
    EachComment
  },
  data () {
    return {
      // user: {},
      isOpen: true,
      isAdd: true
    }
  },
  // computed: {
  //   ...mapGetters(['getUser'])
  // },
  methods: {
    createComment (newComment) {
      if (newComment !== '') {
        axios.post('https://yowlteam.herokuapp.com/api/comments',
          {
            user_id: this.user.id,
            post_id: this.postId,
            content: newComment
          }).then((data) => {
          console.log(data)
        })
          .catch((error) => { console.log(error.response.data) })
      }
    }
  },
  created () {
    // this.user = this.getUser
    // console.log('D: ', this.commentsFiltered)
  }
}
</script>

<style>
.commentManager {
  background-color: aquamarine;
  width: 100%;
}
.addComment{
  width: 30%;
  height: 80px;
  margin-top: 20px;
}
button{
  cursor: pointer;
}
#returnButton{
  cursor: pointer;
}
</style>
