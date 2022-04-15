<template>
  <div class="eachPost">
    <p>{{community.name}} Posted by {{userNAME}} {{moment(date).fromNow()}}</p>
    <br />
    <h1>{{ postNewTitle }}</h1>
    <br />
    <div class="postContent">{{ postNewContent }}</div>
    <br />
    <br />
    <VoteButtons :post="post" />
    <button class="hover" @click="() => TogglePopUp('buttonTrigger')" v-if="userID === this.post.user_id">Edit Post</button>
    <button class="hover" @click="this.$parent.$emit('deletePost', postId)" v-if="userID === this.post.user_id">Delete Post</button>
    <CommentsManager :commentsFiltered="commentsFiltered" :postId="postId"/>
    <EditPost
      v-if="popupTrigger.buttonTrigger"
      :TogglePopUp="() => TogglePopUp('buttonTrigger')"
      @UpdatePost="UpdatePost"
      :post="post"
      :postNewTitle="postNewTitle" :postNewContent="postNewContent"
    >
    </EditPost>
  </div>
</template>

<script>
import moment from 'moment'
import axios from 'axios'
import VoteButtons from '@/components/SharedComponents/VoteButtons.vue'
import CommentsManager from '@/components/SharedComponents/CommentsManager.vue'
import { ref } from 'vue'
import EditPost from '@/components/SharedComponents/EditPost.vue'

export default {
  props: ['post', 'userId', 'userName'],
  name: 'IndexView',
  components: {
    VoteButtons,
    CommentsManager,
    EditPost
  },
  setup () {
    const popupTrigger = ref({
      buttonTrigger: false
    })
    const TogglePopUp = (trigger) => {
      popupTrigger.value[trigger] = !popupTrigger.value[trigger]
    }
    return {
      popupTrigger,
      TogglePopUp
    }
  },
  data () {
    return {
      editPostForm: false,
      commentsFiltered: [],
      community: [],
      date: this.post.created_at,
      postId: this.post.id,
      postNewTitle: this.post.title,
      postNewContent: this.post.content,
      userID: this.userId,
      userNAME: this.userName
    }
  },
  methods: {
    UpdatePost (postId, postTitle, postContent) {
      console.log('I am in post manager update post function')
      axios.put('https://yowlteam.herokuapp.com/api/posts/' + postId,
        {
          title: postTitle,
          content: postContent
        })
        .then((response) => {
          console.log('response is ', response)
          this.postNewTitle = postTitle
          this.postNewContent = postContent
        })
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
  border: solid 2px #15c8cb;
  border-radius: 3px;
  width: 50%;
}

.editPost{
  width: 100%;
  height: 100px;
  margin-top: 20px;
  background-color: transparent;
  border: none;
}
.eachPost p{
  position: relative;
  float: left;
  margin-top: -8px;
  font-size: 15px;
  margin-bottom: 5px;
}
.eachPost h1{
  position: relative;
  float: left;
  margin-top: -8px;
  font-size: 20px;
  margin-bottom: 5px;
}
.postContent{
  font-size: 15px;
  width: 100%;
  text-align: center;
}
</style>
